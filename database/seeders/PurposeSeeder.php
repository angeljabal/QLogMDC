<?php

namespace Database\Seeders;

use App\Models\Purpose;
use Illuminate\Database\Seeder;

class PurposeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            'Enrolment',
            'Request for T.O.R',
            'Request for Good Moral',
            'Buy Book(s)',
            'Buy Uniform(s)',
            'Medical Check-up',
            'Request for I.D Verification',
            'Request for Class Schedules',
            'Request for Grades',
            'Pay Tuition'
        ];

        foreach($data as $purpose){
            Purpose::create(['title'=>$purpose]);
        }  
    }
}
