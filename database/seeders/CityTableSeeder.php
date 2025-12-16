<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\City;
use App\Models\Country;

class CityTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $cities = [
            'Bucharest' => 1,
            'New York' => 2,  
            'London' => 3,    
            'Berlin' => 4,    
            'Paris' => 5,     
            'Rome' => 6,       
            'Madrid' => 7, 
            'Toronto' => 8,    
            'Sydney' => 9,     
            'Tokyo' => 10,     
        ];

        foreach ($cities as $cityName => $countryId) {
            for ($i = 1; $i <= 10; $i++) {
                City::create([
                    'city_name' => $cityName . ' ' . $i,
                    'idCountry' => $countryId,
                    'city_PC' => mt_rand(1000, 9999),
                ]);
            }
        }
    }
}
