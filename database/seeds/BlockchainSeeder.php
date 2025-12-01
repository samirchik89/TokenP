<?php

use Illuminate\Database\Seeder;
use App\BlockchainModel as Blockchain;
use App\Stablecoin;
use App\BlockchainStablecoin;
use App\IssuerStablecoinWalletAddress;



class BlockchainSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Blockchain::truncate();
        Stablecoin::truncate();
        BlockchainStablecoin::truncate();

        // Create Ethereum blockchain
        $ethereum = Blockchain::create([
            'blockchain_name' => 'Ethereum',
            'abbreviation' => 'ETH',
            'link' => 'https://sepolia.etherscan.io/',
            'chain_id' => 11155111
        ]);
        

        // Create stablecoins
        $usdc = Stablecoin::create(['title' => 'USDC']);
        $usdt = Stablecoin::create(['title' => 'USDT']);
        $blockchainStablecoins = [
            [
                'address' => '0xCA12DDD5595af78777673F673E5D9dB6732Fc23E',
                'decimals' => 18,
                'blockchain_id' => $ethereum->id,
                'stablecoin_id' => $usdc->id,
            ],
            [
                'address' => '0x70E3A2bd47f690328015A49E66747431B74C4e1f  ',
                'decimals' => 18,
                'blockchain_id' => $ethereum->id,
                'stablecoin_id' => $usdt->id,
                
            ],
         
        ];

        foreach ($blockchainStablecoins as $data) {
            BlockchainStablecoin::create($data);
        }


        // Create Polygon blockchain
        $polygon = Blockchain::create([
            'blockchain_name' => 'Polygon',
            'abbreviation'    => 'MATIC',
            'link'            => 'https://amoy.polygonscan.com/',
            'chain_id'        => 80001,
        ]);

        // Use the same stablecoins (USDC and USDT) that you already created
        $usdc = Stablecoin::where('title', 'USDC')->first();
        $usdt = Stablecoin::where('title', 'USDT')->first();

        $polygonStablecoins = [
            [
                'address'        => '0x8a867C82fDD768A0C7a532BF975E444502D8A10b',
                'decimals'       => 18,
                'blockchain_id'  => $polygon->id,
                'stablecoin_id'  => $usdc->id,
            ],
            [
                'address'        => '0xbe0c1c40258D5317743D9f19900B296C9da866Ec',
                'decimals'       => 18,
                'blockchain_id'  => $polygon->id,
                'stablecoin_id'  => $usdt->id,
            ],
        ];

        foreach ($polygonStablecoins as $data) {
            BlockchainStablecoin::create($data);
        }

    }
}
