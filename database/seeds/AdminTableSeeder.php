<?php

use Illuminate\Database\Seeder;

class AdminTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('admins')->truncate();
        DB::table('admins')->insert([
            'name' => 'Admin',
            'email' => 'admin@demo.com',
            'picture' => '',
            'password' => bcrypt('123456'),
            //'role' => 0,
	    'wallet_address' => '0xd8781f9a20E07AC0539CC0CBC112c65188658816',
        ]);
    }
}
