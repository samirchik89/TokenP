<?php

use Illuminate\Database\Seeder;

class TokenAddressSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('stablecoins')->where('id', 1)->update([
            'token_address' => '0xCA12DDD5595af78777673F673E5D9dB6732Fc23E', // Replace with actual address
        ]);
    }
}
