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
            [
                'name'          => 'Guidance Office',
                'code'          => 'GU01',
                'head'          => 'Raym Trabajo',
                'building'      => 'College Building',
            ],
            [
                'name'          => 'SSG Office',
                'code'          => 'SS',
                'head'          => 'Josephine Aplacador',
                'building'      => 'College Building',
            ],
            [
                'name'          => 'Scholarship Office',
                'code'          => 'SC',
                'head'          => 'Angelica Lanoy',
                'building'      => 'College Building',
            ],
            [
                'name'          => 'College of Accountancy, Business, and Manangement - Business Department',
                'code'          => 'CAB',
                'head'          => 'Angelica Balatucan',
                'building'      => 'College Building',
            ],
            [
                'name'          => 'College of Accountancy, Business, and Manangement - Hospitality Department',
                'code'          => 'CAH',
                'head'          => 'Sheila A. Monte de Ramos',
                'building'      => 'College Building',
            ],
            [
                'name'          => 'College of Arts, Sciences, and Technology',
                'code'          => 'CA',
                'head'          => 'Josefina Pangan',
                'building'      => 'College Building',
            ],
            [
                'name'          => 'College of Criminal Justice',
                'code'          => 'CC',
                'head'          => 'Avelino Lofranco',
                'building'      => 'College Building',
            ],
            [
                'name'          => 'College of Education',
                'code'          => 'COE',
                'head'          => 'Nymfa Reserva',
                'building'      => 'College Building',
            ],
            [
                'name'          => 'College of Nursing',
                'code'          => 'CON',
                'head'          => 'Rosario Poligrates',
                'building'      => 'College Building',
            ],
            [
                'name'          => 'Library',
                'code'          => 'LI',
                'head'          => 'Edna Coscos',
                'building'      => 'College Building',
            ],
            [
                'name'          => 'Multi Media Center',
                'code'          => 'MU',
                'head'          => 'Jorge Lerin',
                'building'      => 'College Building',
            ],
            [
                'name'          => 'Graduates School Office',
                'code'          => 'GR',
                'head'          => 'Haydee Cabasan',
                'building'      => 'College Building',
            ],
            [
                'name'          => 'President’s Office',
                'code'          => 'PRE',
                'head'          => 'Damilyn Samijon',
                'building'      => 'College Building',
            ],
            [
                'name'          => 'Sports',
                'code'          => 'SP',
                'head'          => 'Joel Balibagoso',
                'building'      => 'Activity Center',
            ],
            [
                'name'          => 'Bookstore',
                'code'          => 'BO',
                'head'          => 'Josue Basio',
                'building'      => 'College Building',
            ],
            [
                'name'          => 'Principal’s Office',
                'code'          => 'PRI01',
                'head'          => 'Jasmin Sumipo',
                'building'      => 'Highschool Building',
            ],
            [
                'name'          => 'Campus Ministry Office',
                'code'          => 'CA',
                'head'          => 'Pedro Aplacador',
                'building'      => 'College Building',
            ],
            [
                'name'          => 'Nurse Office',
                'code'          => 'NU',
                'head'          => 'Sheila Asubar',
                'building'      => 'Highschool Building',
            ],
            [
                'name'          => 'Speech Labratory',
                'code'          => 'SP',
                'head'          => 'Hayde Cabasan',
                'building'      => 'College Building',
            ],
            [
                'name'          => 'Science Labratory',
                'code'          => 'SC',
                'head'          => 'Hayde Cabasan',
                'building'      => 'College Building',
            ],
            [
                'name'          => 'Science Labratory',
                'code'          => 'SC',
                'head'          => 'Hayde Cabasan',
                'building'      => 'College Building',
            ],
            [
                'name'          => 'Activity Center',
                'code'          => 'AC',
                'head'          => 'Joel Balibagoso',
                'building'      => 'College Building',
            ],
            



        ];

        foreach($data as $facility){
            Facility::create($facility);
        }
    }
}
