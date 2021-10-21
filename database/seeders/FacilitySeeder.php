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
                'code'          => 'RO',
                // 'head'          => 'Jose Ruel Alampayan',
                'building'      => 'College Building',
            ],
            [
                'name'          => 'Finance Office',
                'code'          => 'FO01',
                // 'head'          => 'Dianne Sab Gastanes',
                'building'      => 'College Building',
            ],
        ];

        foreach($data as $facility){
            Facility::create($facility);
        }
    }
}
