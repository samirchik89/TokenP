<?php

use Illuminate\Database\Seeder;

class BlockchainChainIdSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('blockchains')->where('abbreviation', 'ETH')->update([
            'test_chain_id' => 111555111,
            'production_chain_id' => 1,
        ]);
    }
}
