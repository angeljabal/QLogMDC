<?php

namespace Database\Seeders;

use App\Models\Department;
use Illuminate\Database\Seeder;

class DepartmentSeeder extends Seeder
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
                'name'      => 'College of Accountancy, Business, and Manangement - Hospitality Department',
                'acronym'   => 'CABM-H',
                'dean'      => 'Mr. Edgardo Buhayang'
            ],
            [
                'name'      => 'College of Accountancy, Business, and Manangement - Business Department',
                'acronym'   => 'CABM-B',
                'dean'      => 'Mr. Edgardo Buhayang'
            ],
            [
                'name'      => 'College of Arts, Sciences, and Technology',
                'acronym'   => 'CAST',
                'dean'      => 'Mrs. Josefina Pangan'
            ],
            [
                'name'      => 'College of Criminal Justice',
                'acronym'   => 'CCJ',
                'dean'      => 'Mr. Avelino Lofranco'
            ],
            [
                'name'      => 'College of Education',
                'acronym'   => 'COE',
                'dean'      => 'Dr. Ma. Nymfa Reserve'
            ],
            [
                'name'      => 'College of Nursing',
                'acronym'   => 'CON',
                'dean'      => 'Dr. Rosario Poligrates'
            ],
        ];

        foreach($data as $department){
            Department::create($department);
        }
    }
}
