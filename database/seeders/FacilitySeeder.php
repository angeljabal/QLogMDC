<?php

namespace Database\Seeders;

use App\Models\Facility;
use Illuminate\Database\Seeder;

class FacilitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'name'          => 'Registrar Office',
                'code'          => '',
                'head'          => '',
                'building'      => '',
                'room_number'   => '',
            ],

        ];

        foreach($data as $facility){
            Facility::create($facility);
        }
    }
}
