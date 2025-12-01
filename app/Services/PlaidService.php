<?php

namespace App\Services;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Support\Facades\Log;
use Exception;
use Illuminate\Support\Arr;

class PlaidService
{
    protected $clientId;
    protected $secret;
    protected $baseUrl;
    protected $httpClient;

    const PRODUCT_AUTH = 'auth';
    const PRODUCT_TRANSACTIONS = 'transactions';
    const PRODUCT_TRANSFERS = 'transfer';
    const PRODUCT_IDENTITY = 'identity';
    const PRODUCT_ASSETS = 'assets';
    const PRODUCT_INVESTMENTS = 'investments';
    const PRODUCT_LIABILITIES = 'liabilities';

    const PRODUCT_SIGNAL = 'signal';
    const PRODUCT_FRAUD_RISK = 'fraud_risk';
    public function basicProducts()
    {
        return [
            self::PRODUCT_AUTH,
            self::PRODUCT_TRANSACTIONS,
            self::PRODUCT_TRANSFERS,
            self::PRODUCT_IDENTITY,
            self::PRODUCT_SIGNAL,
            // self::PRODUCT_FRAUD_RISK,
        ];
    }

    public function __construct()
    {
        $appEnvironment = config('services.environment', 'sandbox');
        if ($appEnvironment == 'production') {
            $this->clientId = config('plaid.production.client_id');
            $this->secret = config('plaid.production.secret');
        } else {
            $this->clientId = config('plaid.sandbox.client_id');
            $this->secret = config('plaid.sandbox.secret');
        }

        switch ($appEnvironment) {
            case 'sandbox':
                $this->baseUrl = 'https://sandbox.plaid.com';
                break;
            case 'development':
                $this->baseUrl = 'https://development.plaid.com';
                break;
            case 'production':
                $this->baseUrl = 'https://production.plaid.com';
                break;
            default:
                $this->baseUrl = 'https://sandbox.plaid.com';
        }

        $this->httpClient = new Client([
            'base_uri' => $this->baseUrl,
            'timeout' => 30,
            'headers' => [
                'Content-Type' => 'application/json',
                'Accept' => 'application/json'
            ]
        ]);
    }

    /**
     * Make HTTP request to Plaid API
     */
    private function makeRequest($endpoint, $payload)
    {
        try {
            $response = $this->httpClient->post($endpoint, [
                'json' => $payload
            ]);

            $body = $response->getBody()->getContents();
            return json_decode($body, true);
        } catch (RequestException $e) {
            $errorBody = $e->hasResponse() ? $e->getResponse()->getBody()->getContents() : 'No response body';

            Log::error('Plaid API request failed', [
                'endpoint' => $endpoint,
                'status' => $e->hasResponse() ? $e->getResponse()->getStatusCode() : 'No status',
                'error' => $errorBody
            ]);

            throw new Exception('Plaid API request failed: ' . $errorBody);
        }
    }

    /**
     * Create a link token for Plaid Link initialization
     */
    public function createLinkToken($userId, $products = [], $webhook = null, $accessToken = null)
    {
        $products = array_merge($this->basicProducts(), $products);
        $payload = [
            'client_id' => $this->clientId,
            'secret' => $this->secret,
            'user' => [
                'client_user_id' => (string) $userId
            ],
            'client_name' => config('app.name'),
            'products' => $products,
            'country_codes' => ['US'],
            'language' => 'en'
        ];

        if ($webhook) {
            $payload['webhook'] = $webhook;
        }
        if ($accessToken) {
            $payload['access_token'] = $accessToken;
        }

        return $this->makeRequest('/link/token/create', $payload);
    }

    /**
     * Exchange public token for access token
     */
    public function exchangePublicToken($publicToken)
    {
        $payload = [
            'client_id' => $this->clientId,
            'secret' => $this->secret,
            'public_token' => $publicToken
        ];

        return $this->makeRequest('/item/public_token/exchange', $payload);
    }

    /**
     * Get account information
     */
    public function getAccounts($accessToken)
    {
        $payload = [
            'client_id' => $this->clientId,
            'secret' => $this->secret,
            'access_token' => $accessToken
        ];

        return $this->makeRequest('/accounts/get', $payload);
    }

    /**
     * Get account balances
     */
    public function getAccountBalances($accessToken)
    {
        $payload = [
            'client_id' => $this->clientId,
            'secret' => $this->secret,
            'access_token' => $accessToken
        ];

        return $this->makeRequest('/accounts/balance/get', $payload);
    }

    /**
     * Get transactions (legacy endpoint)
     */
    public function getTransactions($accessToken, $startDate, $endDate, $options = [])
    {
        $requestOptions = [];
        $payload = [
            'client_id' => $this->clientId,
            'secret' => $this->secret,
            'access_token' => $accessToken,
            'start_date' => $startDate,
            'end_date' => $endDate,
        ];

        // Add optional parameters
        if (isset($options['count'])) {
            $requestOptions['count'] = $options['count'];
        }
        if (isset($options['offset'])) {
            $requestOptions['offset'] = $options['offset'];
        }
        if (isset($options['account_ids'])) {
            $requestOptions['account_ids'] = $options['account_ids'];
        }
        if (!empty($requestOptions)) {
            $payload['options'] = $requestOptions;
        }
        // dd($payload);

        return $this->makeRequest('/transactions/get', $payload);
    }

    /**
     * Sync transactions (newer endpoint)
     */
    public function syncTransactions($accessToken, $cursor = null, $count = 100)
    {
        $payload = [
            'client_id' => $this->clientId,
            'secret' => $this->secret,
            'access_token' => $accessToken,
            'count' => $count
        ];

        if ($cursor) {
            $payload['cursor'] = $cursor;
        }

        return $this->makeRequest('/transactions/sync', $payload);
    }

    /**
     * Get institution information
     */
    public function getInstitution($institutionId, $countryCodes = ['US'])
    {
        $payload = [
            'client_id' => $this->clientId,
            'secret' => $this->secret,
            'institution_id' => $institutionId,
            'country_codes' => $countryCodes
        ];

        return $this->makeRequest('/institutions/get_by_id', $payload);
    }

    /**
     * Get item information
     */
    public function getItem($accessToken)
    {
        $payload = [
            'client_id' => $this->clientId,
            'secret' => $this->secret,
            'access_token' => $accessToken
        ];

        return $this->makeRequest('/item/get', $payload);
    }

    /**
     * Remove item (disconnect bank account)
     */
    public function removeItem($accessToken)
    {
        $payload = [
            'client_id' => $this->clientId,
            'secret' => $this->secret,
            'access_token' => $accessToken
        ];

        return $this->makeRequest('/item/remove', $payload);
    }

    /**
     * Get auth information (account and routing numbers)
     */
    public function getAuth($accessToken)
    {
        $payload = [
            'client_id' => $this->clientId,
            'secret' => $this->secret,
            'access_token' => $accessToken
        ];

        return $this->makeRequest('/auth/get', $payload);
    }

    public function transferInitiate(
        $accessToken,
    $accountId, $idempotencyKey, $amount, $userData, $type = 'debit', $network = 'ach')
    {
        $payload = [
            'client_id' => $this->clientId,
            'account_id' => $accountId,
            'secret' => $this->secret,
            'access_token' => $accessToken,
            'idempotency_key' => $idempotencyKey,
            'type' => $type,
            'network' => $network,
            'amount' => number_format($amount, 2, '.', ''),
            'user' => [
                'legal_name' => (string) $userData['legal_name'],
            ],
        ];

        if ($network == 'ach') {
            $payload['ach_class'] = 'ppd';
        }

        return $this->makeRequest('/transfer/authorization/create', $payload);
    }

    public function transferCreate($accessToken, $accountId, $authorizationId, $description, $amount = null){
        $payload = [
            'client_id' => $this->clientId,
            'secret' => $this->secret,
            'access_token' => $accessToken,
            'account_id' => $accountId,
            'authorization_id' => $authorizationId,
            'description' => $description,
        ];
        if($amount){
            $payload['amount'] = number_format($amount, 2, '.', '');
        }
        return $this->makeRequest('/transfer/create', $payload);
    }

    /**
     * Save transfer to database after creation
     */
    public function saveTransferToDatabase($transferData, $plaidItemAccount)
    {
        $transfer = \App\Models\PlaidTransfer::create([
            'user_id' => $plaidItemAccount->plaidItem->user_id,
            'plaid_item_id' => $plaidItemAccount->plaid_item_id,
            'plaid_item_account_id' => $plaidItemAccount->id,
            'transfer_id' => $transferData['id'],
            'authorization_id' => $transferData['authorization_id'] ?? null,
            'type' => $transferData['type'],
            'network' => $transferData['network'],
            'amount' => $transferData['amount'],
            'description' => $transferData['description'],
            'status' => $transferData['status'],
            'ach_class' => $transferData['ach_class'] ?? null,
            'origination_account_id' => $transferData['origination_account_id'] ?? null,
            'metadata' => $transferData,
            'created_date' => isset($transferData['created']) ?
                \Carbon\Carbon::parse($transferData['created']) : now(),
        ]);

        return $transfer;
    }

    public function identityGet($accessToken){
        $payload = [
            'client_id' => $this->clientId,
            'secret' => $this->secret,
            'access_token' => $accessToken
        ];
        return $this->makeRequest('/identity/get', $payload);
    }
    /**
     * Match identity
     */
    public function identityMatch($accessToken, $userData,$address = []){
        $payload = [
            'client_id' => $this->clientId,
            'secret' => $this->secret,
            'access_token' => $accessToken,
            'user' => [
                'phone_number' => (string) Arr::get($userData, 'phone_number', ),
                'email_address' => (string) Arr::get($userData, 'email_address', ),
                'legal_name' => (string) Arr::get($userData, 'legal_name', ),
                'address' => [
                    'street' => (string) Arr::get($address, 'street', ),
                    'region' => (string) Arr::get($address, 'region', ),
                    'country' => (string) Arr::get($address, 'country', ),
                    'city' => (string) Arr::get($address, 'city', ),
                    'postal_code' => (string) Arr::get($address, 'postal_code', ),
                ],
            ],
        ];
        return $this->makeRequest('/identity/match', $payload);
    }

    public function signalEvaluate($accessToken,$accountId,$amount,
    $clientTransactionId,$clientUserId, $userData, $address = [],$device ){
        $payload = [
            'client_id' => $this->clientId,
            'secret' => $this->secret,
            'access_token' => $accessToken,
            'account_id' => $accountId,
            'client_transaction_id' => $clientTransactionId,
            'amount' => $amount,
            'client_user_id' => $clientUserId,
            'user' => [
                'name' => [
                    'prefix' => (string) Arr::get($userData, 'prefix', ),
                    'given_name'=>Arr::get($userData, 'given_name', ),
                    'middle_name'=>Arr::get($userData, 'middle_name', ),
                    'family_name'=>Arr::get($userData, 'family_name', ),
                    'suffix'=>Arr::get($userData, 'suffix', ),
                ],
                'phone_number' => (string) Arr::get($userData, 'phone_number', ),
                'email_address' => (string) Arr::get($userData, 'email_address', ),
                'address' => [
                    'city' => (string) Arr::get($address, 'city', ),
                    'region' => (string) Arr::get($address, 'region', ),
                    'street' => (string) Arr::get($address, 'street', ),
                    'postal_code' => (string) Arr::get($address, 'postal_code', ),
                    'country' => (string) Arr::get($address, 'country', ),
                ]
            ],
            'device' => [
                'ip_address' => (string) Arr::get($device, 'ip_address', ),
                'user_agent' => (string) Arr::get($device, 'user_agent', ),
            ],
        ];
        // dd($payload);
        return $this->makeRequest('/signal/evaluate', $payload);
    }
    /**
     * Get identity information
     */
    public function getIdentity($accessToken)
    {
        $payload = [
            'client_id' => $this->clientId,
            'secret' => $this->secret,
            'access_token' => $accessToken
        ];

        return $this->makeRequest('/identity/get', $payload);
    }

    /**
     * Create payment recipient (for UK/EU)
     */
    public function createPaymentRecipient($name, $iban = null, $bacs = null)
    {
        $payload = [
            'client_id' => $this->clientId,
            'secret' => $this->secret,
            'name' => $name
        ];

        if ($iban) {
            $payload['iban'] = $iban;
        }

        if ($bacs) {
            $payload['bacs'] = $bacs;
        }

        return $this->makeRequest('/payment_recipient/create', $payload);
    }

    /**
     * Refresh transactions (force refresh)
     */
    public function refreshTransactions($accessToken)
    {
        $payload = [
            'client_id' => $this->clientId,
            'secret' => $this->secret,
            'access_token' => $accessToken
        ];

        return $this->makeRequest('/transactions/refresh', $payload);
    }

    /**
     * Get categories
     */
    public function getCategories()
    {
        $payload = [
            'client_id' => $this->clientId,
            'secret' => $this->secret
        ];

        return $this->makeRequest('/categories/get', $payload);
    }

    /**
     * Search institutions
     */
    public function searchInstitutions($query, $products = [], $countryCodes = ['US'])
    {
        $payload = [
            'client_id' => $this->clientId,
            'secret' => $this->secret,
            'query' => $query,
            'products' => $products,
            'country_codes' => $countryCodes
        ];

        return $this->makeRequest('/institutions/search', $payload);
    }

    /**
     * Get all institutions
     */
    public function getInstitutions($count = 100, $offset = 0, $countryCodes = ['US'])
    {
        $payload = [
            'client_id' => $this->clientId,
            'secret' => $this->secret,
            'count' => $count,
            'offset' => $offset,
            'country_codes' => $countryCodes
        ];

        return $this->makeRequest('/institutions/get', $payload);
    }

    /**
     * Update item webhook
     */
    public function updateItemWebhook($accessToken, $webhook)
    {
        $payload = [
            'client_id' => $this->clientId,
            'secret' => $this->secret,
            'access_token' => $accessToken,
            'webhook' => $webhook
        ];

        return $this->makeRequest('/item/webhook/update', $payload);
    }

    /**
     * Create a sandbox public token (for testing)
     */
    public function createSandboxPublicToken($institutionId, $initialProducts = ['transactions'])
    {
        $payload = [
            'client_id' => $this->clientId,
            'secret' => $this->secret,
            'institution_id' => $institutionId,
            'initial_products' => $initialProducts
        ];

        return $this->makeRequest('/sandbox/public_token/create', $payload);
    }

    /**
     * Fire a sandbox webhook (for testing)
     */
    public function fireSandboxWebhook($accessToken, $webhookCode)
    {
        $payload = [
            'client_id' => $this->clientId,
            'secret' => $this->secret,
            'access_token' => $accessToken,
            'webhook_code' => $webhookCode
        ];

        return $this->makeRequest('/sandbox/item/fire_webhook', $payload);
    }

    /**
     * Get transfer details
     */
    public function getTransfer($transferId)
    {
        $payload = [
            'client_id' => $this->clientId,
            'secret' => $this->secret,
            'transfer_id' => $transferId
        ];

        return $this->makeRequest('/transfer/get', $payload);
    }

    /**
     * List transfers
     */
    public function listTransfers($startDate = null, $endDate = null, $count = 25, $offset = 0)
    {
        $payload = [
            'client_id' => $this->clientId,
            'secret' => $this->secret,
            'count' => $count,
            'offset' => $offset
        ];

        if ($startDate) {
            $payload['start_date'] = $startDate;
        }

        if ($endDate) {
            $payload['end_date'] = $endDate;
        }

        return $this->makeRequest('/transfer/list', $payload);
    }

    /**
     * Cancel a transfer
     */
    public function cancelTransfer($transferId)
    {
        $payload = [
            'client_id' => $this->clientId,
            'secret' => $this->secret,
            'transfer_id' => $transferId
        ];

        return $this->makeRequest('/transfer/cancel', $payload);
    }

    /**
     * Get transfer authorization
     */
    public function getTransferAuthorization($authorizationId)
    {
        $payload = [
            'client_id' => $this->clientId,
            'secret' => $this->secret,
            'authorization_id' => $authorizationId
        ];

        return $this->makeRequest('/transfer/authorization/get', $payload);
    }

    /**
     * Get transfer events (for webhook processing)
     */
    public function getTransferEvents($startDate = null, $endDate = null, $transferId = null, $count = 25, $offset = 0)
    {
        $payload = [
            'client_id' => $this->clientId,
            'secret' => $this->secret,
            'count' => $count,
            'offset' => $offset
        ];

        if ($startDate) {
            $payload['start_date'] = $startDate;
        }

        if ($endDate) {
            $payload['end_date'] = $endDate;
        }

        if ($transferId) {
            $payload['transfer_id'] = $transferId;
        }

        return $this->makeRequest('/transfer/event/list', $payload);
    }

    /**
     * Sync transfer events (cursor-based approach)
     */
    public function syncTransferEvents($afterId = null, $count = 25)
    {
        $payload = [
            'client_id' => $this->clientId,
            'secret' => $this->secret,
            'after_id' => $afterId,
            'count' => $count
        ];

        return $this->makeRequest('/transfer/event/sync', $payload);
    }

    /**
     * Simulate transfer events (sandbox only)
     */
    public function simulateTransferEvent($transferId, $eventType, $failureReason = null)
    {
        $payload = [
            'client_id' => $this->clientId,
            'secret' => $this->secret,
            'transfer_id' => $transferId,
            'event_type' => $eventType
        ];

        if ($failureReason) {
            $payload['failure_reason'] = $failureReason;
        }

        return $this->makeRequest('/sandbox/transfer/simulate', $payload);
    }
}
