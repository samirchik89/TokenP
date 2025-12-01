<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // DB::table('users')->truncate();
        DB::table('users')->insert([
            'name' => 'investor',
            'email' => 'investor@mailinator.com',
            'password' => bcrypt('123456'),
            'user_type'=>2,
            'verified'=>1,
            //'role' => 0,
 
        ]);
    }
}
