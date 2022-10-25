<?php

namespace Database\Seeders;

use App\Models\State;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $states = [
            [
                'country_id'=> 1,
                'state_name' => 'Alberta',
                "created_at" =>  date('Y-m-d H:i:s'),
                "updated_at" => date('Y-m-d H:i:s'),
            ],
            [
                'country_id'=> 1,
                'state_name' => 'British Columbia',
                "created_at" =>  date('Y-m-d H:i:s'),
                "updated_at" => date('Y-m-d H:i:s'),
                
            ],
            [
                'country_id'=> 1,
                'state_name' => 'Manitoba',
                "created_at" =>  date('Y-m-d H:i:s'),
                "updated_at" => date('Y-m-d H:i:s'),
                
            ], 
            [
                'country_id'=> 1,
                'state_name' => 'Ontrio',
                "created_at" =>  date('Y-m-d H:i:s'),
                "updated_at" => date('Y-m-d H:i:s'),
                
            ],          
            [
                'country_id' => 2,
                'state_name' => 'Delhi',
                "created_at" =>  date('Y-m-d H:i:s'),
                "updated_at" => date('Y-m-d H:i:s'),
                
            ],
            [
                'country_id' => 2,
                'state_name' => 'Gujarat',
                "created_at" =>  date('Y-m-d H:i:s'),
                "updated_at" => date('Y-m-d H:i:s'),
                
            ],
            [
                'country_id'=> 2,
                'state_name' => 'Maharashtra',
                "created_at" =>  date('Y-m-d H:i:s'),
                "updated_at" => date('Y-m-d H:i:s'),
                
            ],
            [
                'country_id'=> 3,
                'state_name' => 'California',
                "created_at" =>  date('Y-m-d H:i:s'),
                "updated_at" => date('Y-m-d H:i:s'),
                
            ],
            [
                'country_id'=> 3,
                'state_name' => 'New York',
                "created_at" =>  date('Y-m-d H:i:s'),
                "updated_at" => date('Y-m-d H:i:s'),
                
            ],
            [
                'country_id'=> 3,
                'state_name' => 'New Jersey',
                "created_at" =>  date('Y-m-d H:i:s'),
                "updated_at" => date('Y-m-d H:i:s'),
                
            ],
           
        ];
        State::insert($states);
    }
}
