<?php

use Illuminate\Database\Seeder;
use App\BlockchainModel as Blockchain;
use App\BlockchainStablecoin;
use App\Stablecoin;
use App\IssuerStableCoin;
use App\IssuerStablecoinWalletAddress;




class BlockchainAndStablecoinSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(){

        BlockchainStablecoin::truncate();
        Stablecoin::truncate();
        Blockchain::truncate();
        IssuerStablecoinWalletAddress::truncate();

        // Create Ethereum blockchain
        $ethereum = Blockchain::create([
            'blockchain_name' => 'Ethereum',
            'abbreviation' => 'ETH',
            'link' => 'https://sepolia.etherscan.io/',
        ]);

        // Create stablecoins
        // $usdt = Stablecoin::create(['title' => 'USDT']);
        $usdc = Stablecoin::create(['title' => 'USDC']);
        // $die  = Stablecoin::create(['title' => 'DIE']);

        // Attach stablecoins to Ethereum with testnet and mainnet addresses
        $stablecoins = [
            ['coin' => $usdc, 'test' => '0xCA12DDD5595af78777673F673E5D9dB6732Fc23E', 'main' => '0xMainAddressUSDT'],
            // ['coin' => $usdc, 'test' => '0xTestAddressUSDC', 'main' => '0xMainAddressUSDC'],
            // ['coin' => $die,  'test' => '0xTestAddressDIE',  'main' => '0xMainAddressDIE'],
        ];

        foreach ($stablecoins as $item) {
            BlockchainStablecoin::create([
                'blockchain_id' => $ethereum->id,
                'stablecoin_id' => $item['coin']->id,
                'address_testnet' => $item['test'],
                'address_mainnet' => $item['main'],
            ]);
        }
    }
}
