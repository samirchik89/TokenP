<?php

namespace App\Http\Controllers\Payment;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\PlaidService;
use App\Models\PlaidItem;
use App\Models\PlaidItemAccount;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Models\PlaidInstitution;
use App\Models\PlaidItemAccountNumber;
use Illuminate\Support\Arr;

class PlaidController extends Controller
{
    protected $plaidService;

    public function __construct(PlaidService $plaidService)
    {
        $this->plaidService = $plaidService;
    }

    public function index()
    {
        $plaidItems = auth()->user()->plaidItems;
        $isIssuer = auth()->user()->isIssuer();
        $layout = $isIssuer ? 'issuer.layout.base' : 'layout.app';
        return view('plaid.index', compact('plaidItems', 'layout'));
    }

    public function connect()
    {
        $isIssuer = auth()->user()->isIssuer();
        $layout = $isIssuer ? 'issuer.layout.base' : 'layout.app';
        return view('plaid.connect', compact('layout'));
    }


    public function accountDetails($itemId)
    {
        // try {
        $plaidItem = PlaidItem::where('id', $itemId)->where('user_id', auth()->id())->first();
        if (!$plaidItem) {
            abort(403);
        }

        $plaidItemAccounts = $plaidItem->accounts;
        // Verify the account belongs to the authenticated user

        // Get fresh balance data
        $balances = $this->plaidService->getAccountBalances(
            $plaidItem->access_token
        );

        // Find matching account balance
        $accountBalances = collect($balances['accounts'])->keyBy('account_id');

        // Get recent transactions
        // $transactions = ['transactions' => []];
        $transactions = $this->plaidService->getTransactions(
            $plaidItem->access_token,
            now()->subDays(30)->format('Y-m-d'),
            now()->format('Y-m-d'),
        );

        $isIssuer = auth()->user()->isIssuer();
        $layout = $isIssuer ? 'issuer.layout.base' : 'layout.app';
        return view('plaid.account-details', compact(
            'plaidItem',
            'plaidItemAccounts',
            'accountBalances',
            'transactions',
            'layout'
        ));
        // } catch (Exception $e) {
        //     return back()->with('error', 'Failed to load account details: ' . $e->getMessage());
        // }
    }

    // public function removeAccount($itemId)
    // {
    //     $plaidItemAccount = PlaidItemAccount::whereHas('plaidItem', function ($query) use ($itemId) {
    //         $query->where('user_id', auth()->id());
    //     })->where('id', $itemId)->first();
    //     if (!$plaidItemAccount) {
    //         return back()->with('error', 'Account not found');
    //     }
    //     $plaidItemAccount->delete();
    //     return back()->with('success', 'Account removed successfully');
    // }

    /**
     * Create link token for Plaid Link
     */
    public function createLinkToken(Request $request)
    {
        try {
            $userId = auth()->id() ?: uniqid();
            $webhook =  route('plaid.webhook');
            $webhook = 'https://a44d-94-158-60-212.ngrok-free.app/plaid/webhook';


            $accessToken = null;
            if ($request->item_id) {
                $plaidItem = auth()->user()->plaidItems()->where('id', $request->item_id)->first();
                if ($plaidItem) {
                    $accessToken = $plaidItem->access_token;
                }
            }

            $response = $this->plaidService->createLinkToken(
                $userId,
                ['auth', 'transactions'],
                $webhook,
                $accessToken
            );

            return response()->json([
                'link_token' => $response['link_token'],
                'expiration' => $response['expiration']
            ]);
        } catch (Exception $e) {
            return response()->json([
                'error' => 'Failed to create link token',
                'message' => $e->getMessage()
            ], 400);
        }
    }

    /**
     * Exchange public token for access token
     */
    public function exchangeToken(Request $request)
    {
        $request->validate([
            'public_token' => 'required|string',
            'institution_id' => 'nullable|string',
            'accounts' => 'nullable|array',
            'title' => 'nullable|string',
            'description' => 'nullable|string'
        ]);

        DB::beginTransaction();

        try {
            $response = $this->plaidService->exchangePublicToken($request->public_token);

            $plaidItem = null;
            if ($request->item_id) {
                $plaidItem = auth()->user()->plaidItems()->where('id', $request->item_id)->first();
            } else {
                $plaidItem = new PlaidItem();
                $plaidItem->user_id = auth()->id();
                $plaidItem->status = 'active';
            }

            if (!$plaidItem->id) {
                $serviceInstitution = $this->plaidService->getInstitution($request->institution_id);
                $institution = PlaidInstitution::storeFromPlaidResponse($serviceInstitution['institution']);
                $plaidItem->plaid_institution_id = $institution->id;
            }

            if ($request->title) {
                $plaidItem->title = $request->title;
            }

            if ($request->description) {
                $plaidItem->description = $request->description;
            }

            $plaidItem->access_token = $response['access_token'];
            $plaidItem->item_id = $response['item_id'];
            $plaidItem->save();

            // Optionally fetch and store account information immediately
            if ($request->fetch_accounts) {
                $this->fetchAndStoreAccounts($plaidItem, true);
            }


            DB::commit();

            return response()->json([
                'success' => true,
                'item_id' => $response['item_id'],
                'plaid_item_id' => $plaidItem->id
            ]);
        } catch (Exception $e) {
            DB::rollBack();
            return response()->json([
                'error' => 'Failed to exchange token',
                'message' => $e->getMessage()
            ], 400);
        }
    }

    /**
     * Get accounts for a connected item
     */
    public function getAccounts($itemId)
    {
        try {
            $plaidItem = auth()->user()->plaidItems()->findOrFail($itemId);

            $response = $this->plaidService->getAccounts($plaidItem->access_token);

            return response()->json([
                'accounts' => $response['accounts'],
                'item' => $response['item']
            ]);
        } catch (Exception $e) {
            return response()->json([
                'error' => 'Failed to get accounts',
                'message' => $e->getMessage()
            ], 400);
        }
    }

    /**
     * Get transactions for a connected item
     */
    public function getTransactions($itemId, Request $request)
    {
        $request->validate([
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date',
            'count' => 'nullable|integer|min:1|max:500',
            'offset' => 'nullable|integer|min:0',
            'account_ids' => 'nullable|array'
        ]);

        try {
            $plaidItem = auth()->user()->plaidItems()->findOrFail($itemId);

            $startDate = $request->start_date ?: now()->subDays(30)->format('Y-m-d');
            $endDate = $request->end_date ?: now()->format('Y-m-d');

            $options = [];
            if ($request->count) {
                $options['count'] = $request->count;
            }
            if ($request->offset) {
                $options['offset'] = $request->offset;
            }
            if ($request->account_ids) {
                $options['account_ids'] = $request->account_ids;
            }

            $response = $this->plaidService->getTransactions(
                $plaidItem->access_token,
                $startDate,
                $endDate,
                $options
            );

            return response()->json([
                'transactions' => $response['transactions'],
                'accounts' => $response['accounts'],
                'total_transactions' => $response['total_transactions']
            ]);
        } catch (Exception $e) {
            return response()->json([
                'error' => 'Failed to get transactions',
                'message' => $e->getMessage()
            ], 400);
        }
    }

    /**
     * Sync transactions using the newer sync endpoint
     */
    public function syncTransactions($itemId, Request $request)
    {
        try {
            $plaidItem = auth()->user()->plaidItems()->findOrFail($itemId);

            $cursor = $plaidItem->transactions_cursor;
            $count = $request->input('count', 100);

            $response = $this->plaidService->syncTransactions(
                $plaidItem->access_token,
                $cursor,
                $count
            );

            // Update the cursor for next sync
            $plaidItem->update([
                'transactions_cursor' => $response['next_cursor']
            ]);

            return response()->json([
                'added' => $response['added'],
                'modified' => $response['modified'],
                'removed' => $response['removed'],
                'next_cursor' => $response['next_cursor'],
                'has_more' => $response['has_more']
            ]);
        } catch (Exception $e) {
            return response()->json([
                'error' => 'Failed to sync transactions',
                'message' => $e->getMessage()
            ], 400);
        }
    }

    /**
     * Get auth information (account and routing numbers)
     */
    public function getAuth($itemId)
    {
        try {
            $plaidItem = auth()->user()->plaidItems()->findOrFail($itemId);

            $response = $this->plaidService->getAuth($plaidItem->access_token);

            return response()->json([
                'accounts' => $response['accounts'],
                'numbers' => $response['numbers']
            ]);
        } catch (Exception $e) {
            return response()->json([
                'error' => 'Failed to get auth info',
                'message' => $e->getMessage()
            ], 400);
        }
    }

    /**
     * Get identity information
     */
    public function getIdentity($itemId)
    {
        try {
            $plaidItem = auth()->user()->plaidItems()->findOrFail($itemId);

            $response = $this->plaidService->getIdentity($plaidItem->access_token);

            return response()->json([
                'accounts' => $response['accounts'],
                'identity' => $response['identity']
            ]);
        } catch (Exception $e) {
            return response()->json([
                'error' => 'Failed to get identity',
                'message' => $e->getMessage()
            ], 400);
        }
    }

    /**
     * Remove/disconnect a bank account
     */
    public function removeItem($itemId)
    {
        try {
            $plaidItem = auth()->user()->plaidItems()->findOrFail($itemId);

            $this->plaidService->removeItem($plaidItem->access_token);

            $plaidItem->accounts()->delete();
            $plaidItem->delete();

            return redirect()->route('plaid.index')->with('success', 'Item removed successfully');
        } catch (Exception $e) {
            return redirect()->route('plaid.index')->with('error', 'Failed to remove item');
        }
    }

    /**
     * Get item information
     */
    public function getItem($itemId)
    {
        try {
            $plaidItem = auth()->user()->plaidItems()->findOrFail($itemId);

            $response = $this->plaidService->getItem($plaidItem->access_token);

            return response()->json($response);
        } catch (Exception $e) {
            return response()->json([
                'error' => 'Failed to get item info',
                'message' => $e->getMessage()
            ], 400);
        }
    }

    /**
     * List all connected items for the user
     */
    public function listItems()
    {
        try {
            $items = auth()->user()->plaidItems()
                ->where('status', '!=', 'removed')
                ->get();

            $itemsWithInfo = $items->map(function ($item) {
                try {
                    $response = $this->plaidService->getItem($item->access_token);
                    return [
                        'id' => $item->id,
                        'item_id' => $item->item_id,
                        'institution_id' => $item->institution_id,
                        'status' => $item->status,
                        'created_at' => $item->created_at,
                        'plaid_info' => $response['item']
                    ];
                } catch (Exception $e) {
                    return [
                        'id' => $item->id,
                        'item_id' => $item->item_id,
                        'institution_id' => $item->institution_id,
                        'status' => 'error',
                        'created_at' => $item->created_at,
                        'error' => $e->getMessage()
                    ];
                }
            });

            return response()->json(['items' => $itemsWithInfo]);
        } catch (Exception $e) {
            return response()->json([
                'error' => 'Failed to list items',
                'message' => $e->getMessage()
            ], 400);
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

        // $signal = $this->getSignalEvaluate(
        //     $plaidItem,
        //     $plaidItemAccount,
        //     $amount,
        //     $idempotencyKey,
        //     $clientUserId,
        //     $mockEvaluateUserData,
        //     $mockAddress,
        //     $device
        // );
        // dd($signal);

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

    public function simulateTransferEvent()
    {
        $transferId = '07721a2e-b5dc-3f83-bc0c-d09973235285';
        //posted, settled, failed, funds_available, or returned
        $eventType = 'posted';
        $failureReason = null;
        $response = $this->plaidService->simulateTransferEvent($transferId, $eventType, $failureReason);
        dd($response);
    }

    public function syncTransferEvents()
    {
        $response = $this->plaidService->syncTransferEvents();
        dd($response);
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
