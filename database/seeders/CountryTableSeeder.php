<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Country;

class CountryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $countries = [
            'Romania',
            'United States',
            'United Kingdom',
            'Germany',
            'France',
            'Italy',
            'Spain',
            'Canada',
            'Australia',
            'Japan',
        ];

        foreach ($countries as $countryName) {
            Country::create([
                'country_name' => $countryName,
            ]);
        }
    }
}
