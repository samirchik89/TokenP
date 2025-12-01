<?php

namespace App\Console\Commands;

use App\Models\CryptoTransfer;
use Illuminate\Console\Command;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Support\Facades\Log;

class CheckTransactionStatus extends Command
{
    protected $signature = 'check:transaction-status';

    protected $description = 'Check transaction status across different networks';

    public function handle()
    {
        $this->info('Checking transaction status...');

        $networks = $this->getNetworks();

        // Get transaction details from command options or use default
        $cryptoTransfers = CryptoTransfer::query()
        ->where('status', CryptoTransfer::STATUS_PENDING)
        ->where('created_at', '<', now()->subMinutes(1))
        ->with(['issuerWallet','issuerWallet.blockchainStablecoin','issuerWallet.blockchainStablecoin.blockchain'])
        ->get();
        // dd($cryptoTransfers);
        Log::info('Checking transaction status for ' . $cryptoTransfers->count() . ' transactions');
        foreach ($cryptoTransfers as $cryptoTransfer) {
            $transactionHash = $cryptoTransfer->transaction_hash;
            $blockchainStablecoin = $cryptoTransfer->issuerWallet->blockchainStablecoin;
            if(!$blockchainStablecoin){
                $cryptoTransfer->setStatus(CryptoTransfer::STATUS_FAILED);
                $cryptoTransfer->save();
                continue;
            }
            $chainId = $blockchainStablecoin->blockchain->chain_id;

            $network = $networks->firstWhere('chainId', $chainId);

            $statusInfo = $this->checkTransactionStatusAtNetwork($transactionHash, $network);

            Log::info('Transaction status info: '. $cryptoTransfer->id . ' ' . json_encode($statusInfo));
            if($statusInfo['success']){
                if($statusInfo['status'] == self::STATUS_SUCCESS){
                    $cryptoTransfer->setStatus(CryptoTransfer::STATUS_COMPLETED);
                }else{
                    $cryptoTransfer->setStatus(CryptoTransfer::STATUS_FAILED);
                }
                $cryptoTransfer->save();
            }
        }

        return 0;
    }

    public function getNetworks(){
        return collect([
            [
                'name' => 'Sepolia',
                'chainId' => 11155111,
                'icon' => 'https://assets.coingecko.com/coins/images/3408/large/Tether-logo.png?1598003707',
                'explorerUrl' => 'https://sepolia.etherscan.io',
                'apiUrl' => 'https://api-sepolia.etherscan.io/api',
                'nativeCurrency' => [
                    'name' => 'Sepolia Ether',
                    'symbol' => 'SEP',
                    'decimals' => 18
                ],
                'rpcUrls' => [
                    'https://rpc.sepolia.org',
                    // 'https://sepolia.infura.io/v3/9aa3d95b3bc440fa88ea12eaa4456161',
                    'https://0xrpc.io/sep',
                    'https://eth-sepolia.g.alchemy.com/v2/demo'
                ],
            ],
            [
                'name' => 'Ethereum Mainnet',
                'chainId' => 1,
                'icon' => 'https://assets.coingecko.com/coins/images/279/large/ethereum.png?1595348880',
                'explorerUrl' => 'https://etherscan.io',
                'apiUrl' => 'https://api.etherscan.io/api',
                'nativeCurrency' => [
                    'name' => 'Ether',
                    'symbol' => 'ETH',
                    'decimals' => 18
                ],
                'rpcUrls' => [
                    'https://rpc.ankr.com/eth',
                    'https://mainnet.infura.io/v3/9aa3d95b3bc440fa88ea12eaa4456161',
                    'https://eth-mainnet.g.alchemy.com/v2/demo',
                    'https://cloudflare-eth.com'
                ],
            ],
            [
                'name' => 'Polygon',
                'chainId' => 137,
                'icon' => 'https://assets.coingecko.com/coins/images/4713/large/matic-token-icon.png?1624446912',
                'explorerUrl' => 'https://polygonscan.com',
                'apiUrl' => 'https://api.polygonscan.com/api',
                'nativeCurrency' => [
                    'name' => 'MATIC',
                    'symbol' => 'MATIC',
                    'decimals' => 18
                ],
                'rpcUrls' => [
                    'https://polygon-rpc.com',
                    'https://rpc-mainnet.maticvigil.com',
                    'https://polygon-mainnet.public.blastapi.io',
                    'https://polygon.llamarpc.com'
                ],
            ],
            [
                'name' => 'Polygon Mumbai',
                'chainId' => 80001,
                'icon' => 'https://assets.coingecko.com/coins/images/4713/large/matic-token-icon.png?1624446912',
                'explorerUrl' => 'https://mumbai.polygonscan.com',
                'apiUrl' => 'https://api-testnet.polygonscan.com/api',
                'nativeCurrency' => [
                    'name' => 'MATIC',
                    'symbol' => 'MATIC',
                    'decimals' => 18
                ],
                'rpcUrls' => [
                    'https://rpc-mumbai.maticvigil.com',
                    'https://polygon-mumbai.infura.io/v3/9aa3d95b3bc440fa88ea12eaa4456161',
                    'https://polygon-mumbai.g.alchemy.com/v2/demo',
                    'https://polygon-testnet.public.blastapi.io'
                ],
            ],
        ]);
    }

    const STATUS_SUCCESS = 'success';
    const STATUS_FAILED = 'failed';
    const STATUS_PENDING = 'pending';

    protected function checkTransactionStatusAtNetwork($hash, $network)
    {
        $client = new Client(['timeout' => 30]);

        try {
            // Try multiple RPC endpoints in case of rate limits
            foreach ($network['rpcUrls'] as $rpcUrl) {
                $this->info("Trying RPC endpoint: " . $rpcUrl);

                try {
                    // Check transaction receipt using RPC
                    $receiptData = $this->getTransactionReceiptRPC($hash, $rpcUrl, $client);

                    if ($receiptData && isset($receiptData['result'])) {
                        $receipt = $receiptData['result'];

                        // Get transaction details
                        $txData = $this->getTransactionByHashRPC($hash, $rpcUrl, $client);

                        $status = self::STATUS_FAILED;
                        if (isset($receipt['status'])) {
                            $status = $receipt['status'] == '0x1' ? self::STATUS_SUCCESS : self::STATUS_FAILED;
                        }

                        return [
                            'success' => true,
                            'status' => $status,
                            'receipt_status' => $receipt['status'] ?? 'unknown',
                            'details' => $txData,
                            'receipt' => $receipt,
                            'network' => $network
                        ];
                    }
                } catch (\Exception $e) {
                    $this->warn("RPC endpoint failed: " . $e->getMessage());
                    continue; // Try next endpoint
                }
            }

            // If all RPC endpoints fail, try public APIs
            $this->info("All RPC endpoints failed, trying public APIs...");
            return $this->checkTransactionStatusPublicAPI($hash, $network, $client);

        } catch (RequestException $e) {
            $this->error("Network error: " . $e->getMessage());
            return [
                'success' => false,
                'error' => 'Network request failed: ' . $e->getMessage(),
                'network' => $network
            ];
        } catch (\Exception $e) {
            $this->error("Unexpected error: " . $e->getMessage());
            return [
                'success' => false,
                'error' => 'Unexpected error: ' . $e->getMessage(),
                'network' => $network
            ];
        }
    }

    protected function getTransactionReceiptRPC($hash, $rpcUrl, $client)
    {
        try {
            $payload = [
                'jsonrpc' => '2.0',
                'method' => 'eth_getTransactionReceipt',
                'params' => [$hash],
                'id' => 1
            ];

            $response = $client->post($rpcUrl, [
                'headers' => ['Content-Type' => 'application/json'],
                'json' => $payload
            ]);

            return json_decode($response->getBody(), true);

        } catch (\Exception $e) {
            $this->warn("RPC receipt check failed: " . $e->getMessage());
            return null;
        }
    }

    protected function getTransactionByHashRPC($hash, $rpcUrl, $client)
    {
        try {
            $payload = [
                'jsonrpc' => '2.0',
                'method' => 'eth_getTransactionByHash',
                'params' => [$hash],
                'id' => 1
            ];

            $response = $client->post($rpcUrl, [
                'headers' => ['Content-Type' => 'application/json'],
                'json' => $payload
            ]);

            $data = json_decode($response->getBody(), true);

            if (isset($data['result']) && $data['result']) {
                $tx = $data['result'];

                return [
                    'hash' => $tx['hash'] ?? $hash,
                    'from' => $tx['from'] ?? 'Unknown',
                    'to' => $tx['to'] ?? 'Unknown',
                    'value' => isset($tx['value']) ? hexdec($tx['value']) / pow(10, 18) : 0,
                    'gas' => isset($tx['gas']) ? hexdec($tx['gas']) : 0,
                    'gasPrice' => isset($tx['gasPrice']) ? hexdec($tx['gasPrice']) : 0,
                    'blockNumber' => isset($tx['blockNumber']) ? hexdec($tx['blockNumber']) : null,
                    'nonce' => isset($tx['nonce']) ? hexdec($tx['nonce']) : null,
                ];
            }

            return null;

        } catch (\Exception $e) {
            $this->warn("RPC transaction check failed: " . $e->getMessage());
            return null;
        }
    }

    protected function checkTransactionStatusPublicAPI($hash, $network, $client)
    {
        try {
            // Use public blockchain APIs that don't require keys
            $publicApis = [
                'sepolia' => "https://api-sepolia.etherscan.io/api?module=proxy&action=eth_getTransactionReceipt&txhash={$hash}",
                'mainnet' => "https://api.etherscan.io/api?module=proxy&action=eth_getTransactionReceipt&txhash={$hash}",
                'polygon' => "https://api.polygonscan.com/api?module=proxy&action=eth_getTransactionReceipt&txhash={$hash}",
                'mumbai' => "https://api-testnet.polygonscan.com/api?module=proxy&action=eth_getTransactionReceipt&txhash={$hash}"
            ];

            $networkKey = $this->getNetworkKey($network['chainId']);
            $apiUrl = $publicApis[$networkKey] ?? null;

            if (!$apiUrl) {
                throw new \Exception("No public API available for this network");
            }

            $response = $client->get($apiUrl);
            $data = json_decode($response->getBody(), true);

            if (isset($data['result']) && $data['result']) {
                $receipt = $data['result'];

                // Get transaction details
                $txUrl = str_replace('eth_getTransactionReceipt', 'eth_getTransactionByHash', $apiUrl);
                $txResponse = $client->get($txUrl);
                $txData = json_decode($txResponse->getBody(), true);

                $status = 'failed';
                if (isset($receipt['status'])) {
                    $status = $receipt['status'] == '0x1' ? 'success' : 'failed';
                }

                $txDetails = null;
                if (isset($txData['result']) && $txData['result']) {
                    $tx = $txData['result'];
                    $txDetails = [
                        'hash' => $tx['hash'] ?? $hash,
                        'from' => $tx['from'] ?? 'Unknown',
                        'to' => $tx['to'] ?? 'Unknown',
                        'value' => isset($tx['value']) ? hexdec($tx['value']) / pow(10, 18) : 0,
                        'gas' => isset($tx['gas']) ? hexdec($tx['gas']) : 0,
                        'gasPrice' => isset($tx['gasPrice']) ? hexdec($tx['gasPrice']) : 0,
                        'blockNumber' => isset($tx['blockNumber']) ? hexdec($tx['blockNumber']) : null,
                        'nonce' => isset($tx['nonce']) ? hexdec($tx['nonce']) : null,
                    ];
                }

                return [
                    'success' => true,
                    'status' => $status,
                    'receipt_status' => $receipt['status'] ?? 'unknown',
                    'details' => $txDetails,
                    'receipt' => $receipt,
                    'network' => $network
                ];
            } else {
                return [
                    'success' => false,
                    'error' => 'Transaction not found or pending',
                    'network' => $network
                ];
            }

        } catch (\Exception $e) {
            return [
                'success' => false,
                'error' => 'Public API check failed: ' . $e->getMessage(),
                'network' => $network
            ];
        }
    }

    protected function getNetworkKey($chainId)
    {
        switch ($chainId) {
            case 11155111:
                return 'sepolia';
            case 1:
                return 'mainnet';
            case 137:
                return 'polygon';
            case 80001:
                return 'mumbai';
            default:
                return 'mainnet';
        }
    }

    protected function getTransactionDetails($hash, $network, $client, $apiKey)
    {
        // This method is now deprecated in favor of RPC methods
        // Keeping for backward compatibility
        return $this->getTransactionByHashRPC($hash, $network['rpcUrls'][0], $client);
    }

    protected function displayTransactionStatus($status, $network)
    {
        $this->line('');
        $this->info('=== Transaction Status ===');

        if ($status['success']) {
            $this->info("✅ Transaction Status: " . strtoupper($status['status']));
            $this->info("Network: {$network['name']}");

            if (isset($status['details']['hash'])) {
                $this->info("Explorer: {$network['explorerUrl']}/tx/{$status['details']['hash']}");
            }

            if ($status['details']) {
                $this->line('');
                $this->info('=== Transaction Details ===');
                $this->line("Hash: {$status['details']['hash']}");
                $this->line("From: {$status['details']['from']}");
                $this->line("To: {$status['details']['to']}");
                $this->line("Value: {$status['details']['value']} {$network['nativeCurrency']['symbol']}");
                $this->line("Gas Used: {$status['details']['gas']}");
                $this->line("Gas Price: {$status['details']['gasPrice']} wei");

                if ($status['details']['blockNumber']) {
                    $this->line("Block Number: {$status['details']['blockNumber']}");
                }

                // Check if receipt data is available
                if (isset($status['receipt']) && $status['receipt']) {
                    $receipt = $status['receipt'];
                    $this->line('');
                    $this->info('=== Receipt Details ===');
                    $this->line("Status: " . ($receipt['status'] == '0x1' ? 'Success' : 'Failed'));

                    if (isset($receipt['gasUsed'])) {
                        $this->line("Gas Used: " . hexdec($receipt['gasUsed']));
                    }

                    if (isset($receipt['cumulativeGasUsed'])) {
                        $this->line("Cumulative Gas Used: " . hexdec($receipt['cumulativeGasUsed']));
                    }

                    if (isset($receipt['effectiveGasPrice'])) {
                        $this->line("Effective Gas Price: " . hexdec($receipt['effectiveGasPrice']) . " wei");
                    }
                }
            }
        } else {
            $this->error("❌ Transaction Check Failed");
            $this->error("Error: {$status['error']}");
            $this->error("Network: {$network['name']}");
        }

        $this->line('');
    }
}