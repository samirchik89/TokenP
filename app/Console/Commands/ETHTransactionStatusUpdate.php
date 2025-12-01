<?php

namespace App\Console\Commands;

use App\WithdrawEth;
use App\User;
use GuzzleHttp\Client;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class ETHTransactionStatusUpdate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'eth:statusupdate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Used to check transaction';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {


        \Log::info("WithdrawEth Transaction Status Checking Cron Started............................");
        $withdraws = WithdrawEth::whereIn('status', ['pending'])->get();
        $client = new Client();
        if (!empty($withdraws)) {
            foreach ($withdraws as $key => $withdraw) {
                $getTransaction = $client->get('https://api-sepolia.etherscan.io/api?module=transaction&action=gettxreceiptstatus&txhash=' . $withdraw->tx_hash . '&apikey='.env('ETHERSCANKEY'));
                $transaction = json_decode($getTransaction->getBody(), true);
                \Log::info("Transaction Check For withdraw");
                // \Log::info(json_encode($transaction));
                if (isset($transaction['status']) && $transaction['status'] == '1') {
                    $withdraw->status = ($transaction['result']['status'] == '1') ? 'success' : 'pending';
                    $withdraw->reason = "Transaction Done";
                    $withdraw->save();
                }
            }
        }
    }
}
