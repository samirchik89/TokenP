<?php

namespace App\Http\Controllers\Payment;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\PlaidService;
use App\Models\PlaidItem;
use App\Models\PlaidItemAccount;
use App\Models\PlaidTransfer;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Models\PlaidInstitution;
use App\Models\PlaidItemAccountNumber;
use Illuminate\Support\Arr;

class PlaidWebHookController extends Controller
{
    protected $plaidService;

    public function __construct(PlaidService $plaidService)
    {
        $this->plaidService = $plaidService;
    }


    /**
     * Handle Plaid webhooks
     */
    public function handleWebhook(Request $request)
    {
        Log::info('Plaid webhook received', $request->all());

        $webhookType = $request->input('webhook_type');
        $webhookCode = $request->input('webhook_code');
        $itemId = $request->input('item_id');

        try {
            switch ($webhookType) {
                case 'TRANSACTIONS':
                    $this->handleTransactionWebhook($webhookCode, $itemId, $request->all());
                    break;
                case 'ITEM':
                    $this->handleItemWebhook($webhookCode, $itemId, $request->all());
                    break;
                case 'AUTH':
                    $this->handleAuthWebhook($webhookCode, $itemId, $request->all());
                    break;
                case 'ASSETS':
                    $this->handleAssetsWebhook($webhookCode, $itemId, $request->all());
                    break;
                case 'TRANSFER':
                    $this->handleTransferWebhook($webhookCode, $itemId, $request->all());
                    break;
            }
        } catch (Exception $e) {
            Log::error('Error processing Plaid webhook', [
                'error' => $e->getMessage(),
                'webhook_data' => $request->all()
            ]);
        }

        return response()->json(['status' => 'received']);
    }

    /**
     * Handle transaction webhooks
     */
    private function handleTransactionWebhook($code, $itemId, $data)
    {
        $plaidItem = PlaidItem::where('item_id', $itemId)->first();

        switch ($code) {
            case 'INITIAL_UPDATE':
                Log::info("Initial transaction update for item: {$itemId}");
                if ($plaidItem) {
                    $plaidItem->update(['status' => 'transactions_ready']);
                }
                break;
            case 'DEFAULT_UPDATE':
                Log::info("New transactions available for item: {$itemId}");
                // You might want to queue a job to fetch new transactions
                break;
            case 'HISTORICAL_UPDATE':
                Log::info("Historical transactions available for item: {$itemId}");
                break;
        }
    }

    /**
     * Handle item webhooks
     */
    private function handleItemWebhook($code, $itemId, $data)
    {
        $plaidItem = PlaidItem::where('item_id', $itemId)->first();

        switch ($code) {
            case 'ERROR':
                Log::error("Item error for item: {$itemId}", $data);
                if ($plaidItem) {
                    $plaidItem->update([
                        'status' => 'error',
                        'error_info' => isset($data['error']) ? $data['error'] : null
                    ]);
                }
                break;
            case 'PENDING_EXPIRATION':
                Log::warning("Item pending expiration for item: {$itemId}");
                if ($plaidItem) {
                    $plaidItem->update(['status' => 'pending_expiration']);
                }
                break;
            case 'USER_PERMISSION_REVOKED':
                Log::info("User permission revoked for item: {$itemId}");
                if ($plaidItem) {
                    $plaidItem->update(['status' => 'revoked']);
                }
                break;
        }
    }

    /**
     * Handle auth webhooks
     */
    private function handleAuthWebhook($code, $itemId, $data)
    {
        switch ($code) {
            case 'AUTOMATICALLY_VERIFIED':
                Log::info("Auth automatically verified for item: {$itemId}");
                break;
            case 'VERIFICATION_EXPIRED':
                Log::warning("Auth verification expired for item: {$itemId}");
                break;
        }
    }

    /**
     * Handle assets webhooks
     */
    private function handleAssetsWebhook($code, $itemId, $data)
    {
        switch ($code) {
            case 'PRODUCT_READY':
                Log::info("Assets product ready for item: {$itemId}");
                break;
            case 'ERROR':
                Log::error("Assets error for item: {$itemId}", $data);
                break;
        }
    }

    /**
     * Handle transfer webhooks
     */
    private function handleTransferWebhook($code, $itemId, $data)
    {
        Log::info("Transfer webhook received", [
            'code' => $code,
            'item_id' => $itemId,
            'data' => $data
        ]);

        switch ($code) {
            case 'TRANSFER_EVENTS_UPDATE':
                $this->handleTransferEventsUpdate($data);
                break;
            case 'RECURRING_TRANSACTIONS_UPDATE':
                $this->handleRecurringTransactionsUpdate($data);
                break;
            default:
                Log::warning("Unknown transfer webhook code: {$code}", $data);
                break;
        }
    }

    /**
     * Handle transfer events update
     */
    private function handleTransferEventsUpdate($data)
    {
        $transferId = Arr::get($data, 'transfer_id');
        $newTransferStatus = Arr::get($data, 'new_transfer_status');
        $oldTransferStatus = Arr::get($data, 'old_transfer_status');
        $failureReason = Arr::get($data, 'failure_reason');

        if (!$transferId) {
            Log::error('Transfer events update received without transfer_id', $data);
            return;
        }

        Log::info("Transfer status update", [
            'transfer_id' => $transferId,
            'old_status' => $oldTransferStatus,
            'new_status' => $newTransferStatus,
            'failure_reason' => $failureReason
        ]);

        // Find existing transfer record
        $transfer = PlaidTransfer::where('transfer_id', $transferId)->first();

        if (!$transfer) {
            // If transfer doesn't exist locally, try to fetch it from Plaid
            $this->createTransferFromPlaidData($transferId, $data);
            return;
        }

        // Update the transfer status
        $updateData = [
            'status' => $newTransferStatus,
            'webhook_data' => $data,
        ];

        // Set status-specific timestamps and data
        switch ($newTransferStatus) {
            case 'posted':
                $updateData['posted_date'] = now();
                Log::info("Transfer posted successfully: {$transferId}");
                break;
            case 'cancelled':
                $updateData['cancelled_date'] = now();
                Log::info("Transfer cancelled: {$transferId}");
                break;
            case 'failed':
                $updateData['failed_date'] = now();
                if ($failureReason) {
                    $updateData['failure_reason'] = $failureReason;
                }
                Log::error("Transfer failed: {$transferId}", ['reason' => $failureReason]);
                break;
            case 'returned':
                $updateData['returned_date'] = now();
                Log::warning("Transfer returned: {$transferId}");
                break;
        }

        $transfer->update($updateData);

        // You can add custom business logic here
        $this->handleTransferStatusChange($transfer, $oldTransferStatus, $newTransferStatus);
    }

    /**
     * Handle recurring transactions update
     */
    private function handleRecurringTransactionsUpdate($data)
    {
        Log::info("Recurring transactions update received", $data);

        // Handle recurring transaction updates here
        // This is used for recurring transfers/standing orders
    }

    /**
     * Create transfer record from Plaid data when webhook is received for unknown transfer
     */
    private function createTransferFromPlaidData($transferId, $webhookData)
    {
        try {
            // Fetch transfer details from Plaid
            $plaidTransferData = $this->plaidService->getTransfer($transferId);

            if (!$plaidTransferData || !isset($plaidTransferData['transfer'])) {
                Log::error("Could not fetch transfer data from Plaid for transfer_id: {$transferId}");
                return null;
            }

            $transferData = $plaidTransferData['transfer'];
            $accountId = Arr::get($transferData, 'account_id');

            // Find the plaid item account
            $plaidItemAccount = PlaidItemAccount::where('account_id', $accountId)->first();

            if (!$plaidItemAccount) {
                Log::error("Could not find PlaidItemAccount for account_id: {$accountId}");
                return null;
            }

            // Create transfer record
            $transfer = PlaidTransfer::create([
                'user_id' => $plaidItemAccount->plaidItem->user_id,
                'plaid_item_id' => $plaidItemAccount->plaid_item_id,
                'plaid_item_account_id' => $plaidItemAccount->id,
                'transfer_id' => $transferId,
                'authorization_id' => Arr::get($transferData, 'authorization_id'),
                'type' => Arr::get($transferData, 'type'),
                'network' => Arr::get($transferData, 'network'),
                'amount' => Arr::get($transferData, 'amount'),
                'description' => Arr::get($transferData, 'description'),
                'status' => Arr::get($webhookData, 'new_transfer_status', 'pending'),
                'ach_class' => Arr::get($transferData, 'ach_class'),
                'origination_account_id' => Arr::get($transferData, 'origination_account_id'),
                'metadata' => $transferData,
                'webhook_data' => $webhookData,
                'created_date' => Arr::get($transferData, 'created') ?
                    \Carbon\Carbon::parse($transferData['created']) : now(),
            ]);

            Log::info("Created transfer record from webhook data: {$transferId}");

            return $transfer;
        } catch (Exception $e) {
            Log::error("Error creating transfer from Plaid data", [
                'transfer_id' => $transferId,
                'error' => $e->getMessage()
            ]);
            return null;
        }
    }

    /**
     * Handle custom business logic when transfer status changes
     */
    private function handleTransferStatusChange($transfer, $oldStatus, $newStatus)
    {
        // Add your custom business logic here
        // For example:
        // - Send notifications to users
        // - Update account balances
        // - Trigger other business processes
        // - Send emails
        // - Update external systems

        switch ($newStatus) {
            case 'posted':
                // Transfer completed successfully
                Log::info("Transfer completed successfully", [
                    'transfer_id' => $transfer->transfer_id,
                    'user_id' => $transfer->user_id,
                    'amount' => $transfer->amount
                ]);
                break;
            case 'failed':
            case 'cancelled':
            case 'returned':
                // Transfer failed - might need to handle refunds or notifications
                Log::warning("Transfer failed/cancelled/returned", [
                    'transfer_id' => $transfer->transfer_id,
                    'user_id' => $transfer->user_id,
                    'status' => $newStatus,
                    'failure_reason' => $transfer->failure_reason
                ]);
                break;
        }
    }

    /**
     * Fetch and store accounts for a plaid item
     */
    private function fetchAndStoreAccounts($plaidItem, $storeAccounts = false)
    {
        try {
            $response = $this->plaidService->getAccounts($plaidItem->access_token);

            if ($storeAccounts) {
                $connectedAccounts = [];
                foreach ($response['accounts'] as $account) {
                    $connectedAccounts[] = $account['account_id'];
                    $plaidItemAccount = PlaidItemAccount::where([
                        'plaid_item_id' => $plaidItem->id,
                        'account_id' => $account['account_id']
                    ])->first();

                    if (!$plaidItemAccount) {
                        $plaidItemAccount = new PlaidItemAccount();
                        $plaidItemAccount->plaid_item_id = $plaidItem->id;
                        $plaidItemAccount->account_id = $account['account_id'];
                    }
                    $plaidItemAccount->name = Arr::get($account, 'name');
                    $plaidItemAccount->persistent_account_id = Arr::get($account, 'persistent_account_id');
                    $plaidItemAccount->official_name = Arr::get($account, 'official_name');
                    $plaidItemAccount->type = Arr::get($account, 'type');
                    $plaidItemAccount->subtype = Arr::get($account, 'subtype');
                    $plaidItemAccount->mask = Arr::get($account, 'mask');
                    $plaidItemAccount->status = 'active';
                    $plaidItemAccount->balances = Arr::get($account, 'balances');
                    $plaidItemAccount->extra_data = $account;
                    $plaidItemAccount->save();
                }
                foreach ($plaidItem->accounts as $account) {
                    if (!in_array($account->account_id, $connectedAccounts)) {
                        $account->delete();
                    }
                }
            }

            return $response['accounts'];
        } catch (Exception $e) {
            Log::error('Failed to fetch and store accounts', [
                'plaid_item_id' => $plaidItem->id,
                'error' => $e->getMessage()
            ]);
            throw $e;
        }
    }

    public function makeTestTransfer()
    {
        $plaidItem = auth()->user()->plaidItems()->first();
        $response = $this->plaidService->getAuth($plaidItem->access_token);
        foreach ($response['numbers'] as $networkKey => $networkNumbers) {
            foreach ($networkNumbers as $networkNumber) {
                $plaidItemAccount = PlaidItemAccount::where('account_id', $networkNumber['account_id'])->first();
                $accountNumber = PlaidItemAccountNumber::firstOrNew([
                    'plaid_item_account_id' => $plaidItemAccount->id,
                    'network_key' => $networkKey
                ]);
                $accountNumber->account = $networkNumber['account'];
                $accountNumber->routing = $networkNumber['routing'];
                $accountNumber->wire_routing = $networkNumber['wire_routing'];
                $accountNumber->save();
            }
        }

        $plaidItemAccount = PlaidItemAccount::where('plaid_item_id', $plaidItem->id)->first();

        $idempotencyKey = uniqid();
        $amount = 10;

        $mockUserData = [
            'legal_name' => 'Alberta Bobbeth Charleson',
            'phone_number' => '1112224444',
            'email_address' => 'accountholder0@example.com'
        ];
        $mockAddress = [
            'street' => '2992 Cameron Road',
            'city' => 'Malakoff',
            'region' => 'NY',
            'postal_code' => '14236',
            'country' => 'US'
        ];
        $clientUserId = '1234567890';
        $device =[
            'ip_address' => '127.0.0.1',
            'user_agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36'
        ];
        $mockEvaluateUserData = [
            'prefix' => 'Mr.',
            'given_name' => 'John',
            'middle_name' => 'Doo',
            'family_name' => 'Doe',
            'suffix' => 'Jr.',
            'phone_number' => '1112224444',
            'email_address' => 'accountholder0@example.com'
        ];
        // Test Routing + Account Numbers
        // Here are sample test account/routing numbers:

        // Routing Number	Account Number	Result
        // 011401533	9900000000	Success
        // 011401533	9900000001	NSF (simulate fail)
        // 011401533	9900000002	Returns
        // $identityMatch = $this->getIdentityMatch($plaidItem->access_token, $mockUserData, $mockAddress);
        // dd($identityMatch);

        $signal = $this->getSignalEvaluate(
            $plaidItem,
            $plaidItemAccount,
            $amount,
            $idempotencyKey,
            $clientUserId,
            $mockEvaluateUserData,
            $mockAddress,
            $device
        );
        dd($signal);

        $response = $this->plaidService->transferInitiate(
            $plaidItem->access_token,
            $plaidItemAccount->account_id,
            $idempotencyKey,
            $amount,
            [
                'legal_name' => 'John Doe'
            ]
        );
        $authorizationId = Arr::get($response, 'authorization.id');
        if ($authorizationId) {
            $transferResponse = $this->plaidService->transferCreate(
                $plaidItem->access_token,
                $plaidItemAccount->account_id,
                $authorizationId,
                'Test transfer',
                $amount
            );
            dd($transferResponse);
        }
        return $response;
    }

    public function getIdentityMatch($accessToken, $userData, $userAddress)
    {
        $response = $this->plaidService->identityMatch($accessToken, $userData, $userAddress);
        $scores = [];
        foreach ($response['accounts'] as $account) {
            $score = [
                'email' => Arr::get($account, 'email_address.score', 0),
                'legal_name' => Arr::get($account, 'legal_name.score', 0),
                'phone' => Arr::get($account, 'phone_number.score', 0),
                'address' => Arr::get($account, 'address.score', 0),
            ];
            $totalScore = array_sum($score) / count($score);
            $score['total'] = $totalScore;
            $score['account_id'] = Arr::get($account, 'account_id');
            $scores[] = $score;
        }
        $totalScore = array_sum(array_column($scores, 'total')) / count($scores);
        dd($scores);
    }

    public function getSignalEvaluate($plaidItem,
    $plaidItemAccount, $amount, $idempotencyKey, $clientUserId,
    $userData,$userAddress,$device){
        $response = $this->plaidService->signalEvaluate(
            $plaidItem->access_token,
            $plaidItemAccount->account_id,
            $amount,
            $idempotencyKey,
            $clientUserId,
            $userData,
            $userAddress,
            $device
        );
        return $response;
    }
}
