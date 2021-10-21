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
            [
                'desc'  =>  'Pay Tuition Fee'
            ],
            [
                'desc'  =>  'Pay for enrollment'
            ],
            [
                'desc'  =>  'Pay for special exam'
            ],
        ];

        foreach($data as $purpose){
            Purpose::create($purpose);
        }    
    }
}
