<?php

use Illuminate\Database\Seeder;

class CoinTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Bank tranfer is getting shown due to these entry
        DB::table('coins')->insert([
            'symbol' => 'USD',
            'coin_name' => 'DUMMY_ENTRY',
            'coin_type' => '1',
            'contract_address' => null, 
            'address' => '1BoatSLRHsdfsdtKNngkdXEeobR76b53LETtpyT',
            'star_reference_counter' => 0,
            'port_reference_counter' => 0,
            'status' => 1, 
            'created_at' => now(),
            'updated_at' => now(),
        ]);

    }
}
