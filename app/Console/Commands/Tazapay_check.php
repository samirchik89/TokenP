<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\UserTokenTransaction;
use GuzzleHttp\Client;

class Tazapay_check extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'tazapay:check';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
     * @return mixed
     */
    public function handle()
    {
        try{
        $user_token=UserTokenTransaction::where('status',3)->get();
        // $client=new Client;
        $headers=[
            'content-type'=>'application/json',
            'Authorization'=> 'Basic '. base64_encode(env('TAZA_API_KEY').':'.env('TAZA__SECRET_KEY'))
        ];
        $client = new Client([
            'headers' => $headers
        ]);
        foreach ($user_token as $value){
        $url= $client->get("https://api-sandbox.tazapay.com/v1/checkout/".$value->access_code);
        $res=json_decode($url->getBody(),true);
        if($res['status']=='success'){
            if($res['data']['state']=='Payment_Received'&& $value->reference==$res['data']['reference_id'] && $res['data']['txn_no']==$value->access_code){
                $user=UserTokenTransaction::where('reference',$res['data']['reference_id'])->first();
            
                $user->status=2;
                $user->txn_hash='Tazapay';
                $user->save();
            }else{
                continue;
            }
        }else{
            continue;
        }
    }
}catch(\Exception $e){
    dd($e->getMessage());
}
    }
}
