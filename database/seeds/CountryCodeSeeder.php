<?php

use App\CountryCode;
use Illuminate\Database\Seeder;

class CountryCodeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = \file_get_contents(public_path("asset/json/CountryCodes.json"));
        CountryCode::insert(json_decode($data, true));
    }
}
