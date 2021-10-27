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
                'building'      => 'College Building',
            ],
            [
                'name'          => 'Finance Office',
                'code'          => 'FO01',
                'building'      => 'College Building',
            ],
            [
                'name'          => 'Guidance Office',
                'code'          => 'GU01',
                'building'      => 'College Building',
            ],
            [
                'name'          => 'SSG Office',
                'code'          => 'SS',
                'building'      => 'College Building',
            ],
            [
                'name'          => 'Scholarship Office',
                'code'          => 'SC',
                'building'      => 'College Building',
            ],
            [
                'name'          => 'College of Accountancy, Business, and Manangement - Business Department',
                'code'          => 'CAB',
                'building'      => 'College Building',
            ],
            [
                'name'          => 'College of Accountancy, Business, and Manangement - Hospitality Department',
                'code'          => 'CAH',
                'building'      => 'College Building',
            ],
            [
                'name'          => 'College of Arts, Sciences, and Technology',
                'code'          => 'CA',
                'building'      => 'College Building',
            ],
            [
                'name'          => 'College of Criminal Justice',
                'code'          => 'CC',
                'building'      => 'College Building',
            ],
            [
                'name'          => 'College of Education',
                'code'          => 'COE',
                'building'      => 'College Building',
            ],
            [
                'name'          => 'College of Nursing',
                'code'          => 'CON',
                'building'      => 'College Building',
            ],
            [
                'name'          => 'Library',
                'code'          => 'LI',
                'building'      => 'College Building',
            ],
            [
                'name'          => 'Multi Media Center',
                'code'          => 'MU',
                'building'      => 'College Building',
            ],
            [
                'name'          => 'Graduates School Office',
                'code'          => 'GR',
                'building'      => 'College Building',
            ],
            [
                'name'          => 'President’s Office',
                'code'          => 'PRE',
                'building'      => 'College Building',
            ],
            [
                'name'          => 'Sports',
                'code'          => 'SP',
                'building'      => 'Activity Center',
            ],
            [
                'name'          => 'Bookstore',
                'code'          => 'BO',
                'building'      => 'College Building',
            ],
            [
                'name'          => 'Principal’s Office',
                'code'          => 'PRI01',
                'building'      => 'Highschool Building',
            ],
            [
                'name'          => 'Campus Ministry Office',
                'code'          => 'CA',
                'building'      => 'College Building',
            ],
            [
                'name'          => 'Nurse Office',
                'code'          => 'NU',
                'building'      => 'Highschool Building',
            ],
            [
                'name'          => 'Speech Labratory',
                'code'          => 'SP',
                'building'      => 'College Building',
            ],
            [
                'name'          => 'Science Labratory',
                'code'          => 'SC',
                'building'      => 'College Building',
            ],
            [
                'name'          => 'Science Labratory',
                'code'          => 'SC',
                'building'      => 'College Building',
            ],
            [
                'name'          => 'Activity Center',
                'code'          => 'AC',
                'building'      => 'College Building',
            ],
            



        ];

        foreach($data as $facility){
            Facility::create($facility);
        }
    }
}
