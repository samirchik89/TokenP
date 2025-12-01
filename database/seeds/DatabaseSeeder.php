<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(CountryTableSeeder::class);
        $this->call(SettingsTableSeeder::class);
        $this->call(AdminTableSeeder::class);
        $this->call(CitiesTableDataSeeder::class);
        $this->call(CountryCodeSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(DemoPropertiesSeeder::class);
    }
}
