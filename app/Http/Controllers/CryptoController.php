<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CryptoTransfer;
use App\IssuerStablecoinWalletAddress;
use App\BlockchainModel as Blockchain;
use App\Enums\PaymentMethod;
use App\KeystoreModel;
use App\Services\TokenPaymentService;
use App\Stablecoin;
use App\UserToken;
use App\TestTokenRequest;
use App\UserContract;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class CryptoController extends Controller
{
    /**
     * Request test tokens
     */
    public function requestTestTokens(Request $request)
    {
        $tokensAmount = 20;
        try {
            $request->validate([
                'wallet_address' => 'required|string|min:26|max:42',
                'blockchain_id' => 'required|integer|exists:blockchains,chain_id',
            ]);

            $user = Auth::user();

            // Check if user has already received test tokens for this address
            // if (TestTokenRequest::hasReceivedTestTokens($user->id)) {
            //     return response()->json([
            //         'status' => 'error',
            //         'message' => 'You have already received test tokens'
            //     ], 400);
            // }

            // Check if there's already a pending request for this address
            $existingRequest = TestTokenRequest::where('user_id', $user->id)
                // ->where('wallet_address', $request->wallet_address)
                ->whereIn('status', ['pending', 'processing'])
                ->first();

            if ($existingRequest) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'You already have a test token request'
                ], 400);
            }

            // Get blockchain info
            $blockchain = Blockchain::where('chain_id', $request->blockchain_id)->first();

            // Get a test contract for the specified blockchain
            $testContract = config('token.token');

            $keyStore = KeystoreModel::first();
            if (!$testContract) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'No test contract available for blockchain: ' . $blockchain->name
                ], 400);
            }

            DB::beginTransaction();
            try {
                // Create test token request
                $testTokenRequest = TestTokenRequest::create([
                    'user_id' => $user->id,
                    'wallet_address' => $request->wallet_address,
                    'blockchain_id' => $blockchain->id,
                    'status' => 'processing',
                    'tokens_sent' => $tokensAmount
                ]);

                // Prepare transfer payload
                $payload = [
                    "amount" => $tokensAmount,
                    "chain" => $blockchain->abbreviation,
                    "privateKey" => $keyStore->getPrivateKey(),
                    "contract_address" => $testContract['contract_address'],
                    "to" => $request->wallet_address
                ];

                // Call node operations to transfer tokens
                $response = callNodeOperations('transfer', $payload);

                if (!empty($response['status']) && $response['status'] === 'success') {
                    // Update request with success
                    $testTokenRequest->update([
                        'status' => 'completed',
                        'transaction_hash' => $response['txHash'] ?? null,
                        'sent_at' => now()
                    ]);

                    DB::commit();

                    Log::info('Test tokens sent automatically', [
                        'request_id' => $testTokenRequest->id,
                        'user_id' => $user->id,
                        'wallet_address' => $request->wallet_address,
                        'blockchain_id' => $blockchain->id,
                        'transaction_hash' => $response['txHash'] ?? null
                    ]);

                    return response()->json([
                        'status' => 'success',
                        'message' => 'Test tokens sent successfully!',
                        'transaction_hash' => $response['txHash'] ?? null,
                        'request_id' => $testTokenRequest->id
                    ]);
                } else {
                    // Update request with failure
                    $testTokenRequest->update([
                        'status' => 'failed'
                    ]);

                    DB::rollBack();

                    Log::error('Failed to send test tokens automatically', [
                        'request_id' => $testTokenRequest->id,
                        'response' => $response
                    ]);

                    return response()->json([
                        'status' => 'error',
                        'message' => 'Failed to send test tokens: ' . ($response['message'] ?? 'Unknown error')
                    ], 500);
                }

            } catch (\Exception $e) {
                DB::rollBack();

                if (isset($testTokenRequest)) {
                    $testTokenRequest->update(['status' => 'failed']);
                }

                Log::error('Exception while sending test tokens automatically', [
                    'user_id' => $user->id,
                    'wallet_address' => $request->wallet_address,
                    'error' => $e->getMessage()
                ]);

                throw $e;
            }

        } catch (\Exception $e) {
            Log::error('Error requesting test tokens', [
                'error' => $e->getMessage(),
                'user_id' => Auth::id(),
                'request_data' => $request->all()
            ]);

            return response()->json([
                'status' => 'error',
                'message' => 'Failed to submit test token request: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Store crypto transfer
     */
    public function store(Request $request)
    {
        $user = Auth::user();
        if (!$user->canMakeInvestment()) {
            return response()->json([
                'status' => 'error',
                'message' => 'You have reached the maximum limit of investments in demo mode.'
            ], 400);
        }
        try {
            Log::info('Crypto transfer store method called', [
                'user_id' => Auth::id(),
                'request_data' => $request->all()
            ]);

            $request->validate([
                'user_token_id' => 'required|string',
                'sender_address' => 'required|string',
                'recipient_address' => 'required|string',
                'amount' => 'required|numeric|min:0',
                'blockchain_stablecoin_id' => 'required|string',
                'transaction_hash' => 'required|string',
            ]);

            Log::info('Crypto transfer validation passed', [
                'user_id' => Auth::id(),
                'user_token_id' => $request->user_token_id,
                'amount' => $request->amount,
                'transaction_hash' => $request->transaction_hash
            ]);

            $userToken = UserToken::where('id', $request->user_token_id)->first();

            if (!$userToken) {
                Log::error('User token not found', [
                    'user_id' => Auth::id(),
                    'user_token_id' => $request->user_token_id
                ]);
                return response()->json([
                    'status' => 'error',
                    'message' => 'User token not found'
                ], 404);
            }

            Log::info('User token retrieved successfully', [
                'user_id' => Auth::id(),
                'user_token_id' => $userToken->id,
                'property_id' => $userToken->usercontract->property->id ?? null
            ]);

            // $paymentMethods = PaymentMethod::labels();
            // $paymentConfigs = getPaymentMethodsJson($paymentMethods,$userToken->usercontract->property->user_id,$userToken->usercontract->id);
            $selectedPaymentId = $request->blockchain_stablecoin_id;
            // $num = 0;
            // foreach($paymentConfigs as $key => $paymentConfig){
            //     if($key == PaymentMethod::CRYPTO_TRANSFER){
            //         $selectedPaymentId = $num;
            //         break;
            //     }
            //     $num++;
            // }

            Log::info('Payment configuration processed', [
                'user_id' => Auth::id(),
                'selected_payment_id' => $selectedPaymentId,
                'payment_method' => PaymentMethod::CRYPTO_TRANSFER
            ]);

            $tokenService = new TokenPaymentService();
            $tokenService->savePaymentDetails(
                $userToken,
                [
                    'payment_method' => PaymentMethod::CRYPTO_TRANSFER,
                    'selected_payment_id' => $selectedPaymentId,
                    'payment_reference' => $request->transaction_hash,
                    'payment_proof' => null,
                ]
            );

            Log::info('Payment details saved to token service', [
                'user_id' => Auth::id(),
                'user_token_id' => $userToken->id,
                'payment_reference' => $request->transaction_hash
            ]);

            // Create crypto transfer record
            $cryptoTransfer = CryptoTransfer::create([
                'user_id' => Auth::id(),
                'sender_address' => $request->sender_address,
                'recipient_address' => $request->recipient_address,
                'amount' => $request->amount,
                'blockchain_stablecoin_id' => $request->blockchain_stablecoin_id,
                'status' => CryptoTransfer::STATUS_PENDING,
                'transaction_hash' => $request->transaction_hash,
                'metadata' => [
                    'from_address' => $request->from_address ?? null,
                    'gas_used' => $request->gas_used ?? null,
                    'gas_price' => $request->gas_price ?? null,
                    'block_number' => $request->block_number ?? null,
                ],
                'user_token_id' => $request->user_token_id,
            ]);

            Log::info('Crypto transfer stored', [
                'transfer_id' => $cryptoTransfer->id,
                'user_id' => Auth::id(),
                'transaction_hash' => $request->transaction_hash,
                'amount' => $request->amount,
                'sender_address' => $request->sender_address,
                'recipient_address' => $request->recipient_address,
                'blockchain_stablecoin_id' => $request->blockchain_stablecoin_id,
                'status' => CryptoTransfer::STATUS_PENDING
            ]);

            return response()->json([
                'status' => 'success',
                'message' => 'Transfer stored successfully',
                'transfer_id' => $cryptoTransfer->id
            ]);

        } catch (\Exception $e) {
            Log::error('Error storing crypto transfer', [
                'error' => $e->getMessage(),
                'request_data' => $request->all()
            ]);

            return response()->json([
                'status' => 'error',
                'message' => 'Failed to store transfer: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Update transfer status
     */
    public function updateStatus(Request $request, $id)
    {
        Log::info('Crypto transfer status update method called', [
            'user_id' => Auth::id(),
            'transfer_id' => $id,
            'request_data' => $request->all()
        ]);

        try {
            $request->validate([
                'status' => 'required|in:pending,completed,failed,cancelled',
                'transaction_hash' => 'required|string',
            ]);

            Log::info('Crypto transfer status update validation passed', [
                'user_id' => Auth::id(),
                'transfer_id' => $id,
                'new_status' => $request->status,
                'transaction_hash' => $request->transaction_hash
            ]);

            $transfer = CryptoTransfer::findOrFail($id);

            Log::info('Crypto transfer found', [
                'user_id' => Auth::id(),
                'transfer_id' => $id,
                'transfer_user_id' => $transfer->user_id,
                'current_status' => $transfer->status,
                'transfer_amount' => $transfer->amount
            ]);

            // Ensure user can only update their own transfers
            if ($transfer->user_id !== Auth::id()) {
                Log::warning('Unauthorized transfer status update attempt', [
                    'user_id' => Auth::id(),
                    'transfer_id' => $id,
                    'transfer_user_id' => $transfer->user_id
                ]);

                return response()->json([
                    'status' => 'error',
                    'message' => 'Unauthorized'
                ], 403);
            }

            Log::info('Transfer ownership verified, proceeding with status update', [
                'user_id' => Auth::id(),
                'transfer_id' => $id,
                'old_status' => $transfer->status,
                'new_status' => $request->status
            ]);

            // Prepare update data
            $transfer->setStatus($request->status);
            $transfer->transaction_hash = $request->transaction_hash;

            // Update metadata with additional transaction details
            $metadata = $transfer->metadata ?? [];
            if ($request->has('gas_used')) {
                $metadata['gas_used'] = $request->gas_used;
            }
            if ($request->has('block_number')) {
                $metadata['block_number'] = $request->block_number;
            }
            if ($request->has('gas_price')) {
                $metadata['gas_price'] = $request->gas_price;
            }

            $transfer->metadata = $metadata;
            $transfer->save();

            Log::info('Crypto transfer status updated successfully', [
                'transfer_id' => $id,
                'user_id' => Auth::id(),
                'old_status' => $transfer->getOriginal('status'),
                'new_status' => $request->status,
                'transaction_hash' => $request->transaction_hash,
                'metadata_updated' => !empty($metadata)
            ]);

            return response()->json([
                'status' => 'success',
                'message' => 'Transfer status updated successfully'
            ]);

        } catch (\Exception $e) {
            Log::error('Error updating crypto transfer status', [
                'transfer_id' => $id,
                'user_id' => Auth::id(),
                'error' => $e->getMessage(),
                'request_data' => $request->all(),
                'stack_trace' => $e->getTraceAsString()
            ]);

            return response()->json([
                'status' => 'error',
                'message' => 'Failed to update transfer status: ' . $e->getMessage()
            ], 500);
        }
    }
}