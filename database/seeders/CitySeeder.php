<?php

namespace Database\Seeders;

use App\Models\City;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $cities = [
            [
                'state_id'=> 1,
                'city_name' => 'Calgary',
                "created_at" => date('Y-m-d H:i:s'),
                "updated_at" => date('Y-m-d H:i:s'),
            ],
            [
                'state_id'=> 2,
                'city_name' => 'Vancouver',
                "created_at" => date('Y-m-d H:i:s'),
                "updated_at" => date('Y-m-d H:i:s'),
                
            ],
            [
                'state_id'=> 3,
                'city_name' => 'Winnipeg',
                "created_at" => date('Y-m-d H:i:s'),
                "updated_at" => date('Y-m-d H:i:s'),
                
            ],
            [
                'state_id'=> 4,
                'city_name' => 'Toronto',
                "created_at" => date('Y-m-d H:i:s'),
                "updated_at" => date('Y-m-d H:i:s'),
                
            ],
            [
                'state_id'=> 5,
                'city_name' => 'NCR',
                "created_at" => date('Y-m-d H:i:s'),
                "updated_at" => date('Y-m-d H:i:s'),
                
            ],
            [
                'state_id'=> 6,
                'city_name' => 'Ahmedabad',
                "created_at" => date('Y-m-d H:i:s'),
                "updated_at" => date('Y-m-d H:i:s'),
                
            ],
            [
                'state_id'=> 7,
                'city_name' => 'Mumbai',
                "created_at" => date('Y-m-d H:i:s'),
                "updated_at" => date('Y-m-d H:i:s'),
                
            ],
            [
                'state_id'=> 8,
                'city_name' => 'San Francisco',
                "created_at" => date('Y-m-d H:i:s'),
                "updated_at" => date('Y-m-d H:i:s'),
                
            ],            
            [
                'state_id'=> 9,
                'city_name' => 'Manhattan',
                "created_at" => date('Y-m-d H:i:s'),
                "updated_at" => date('Y-m-d H:i:s'),
                
            ],            
            [
                'state_id'=> 10,
                'city_name' => 'Newark',
                "created_at" => date('Y-m-d H:i:s'),
                "updated_at" => date('Y-m-d H:i:s'),
                
            ],            
        ];
        City::insert($cities);
    }
}
