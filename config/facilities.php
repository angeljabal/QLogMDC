<?php

use Carbon\Carbon;

return [
    'head'     =>  
    [
        [
            'name'              => 'Dianne Sab Gastanes',
            'email'             => 'faculty_FI@qlog.com',
            'password'          => 'admin123',
            'type'              => 2,
            'email_verified_at' => Carbon::now()
        ],
        [
            'name'              => 'Jose Ruel Alampayan',
            'email'             => 'faculty_RE@qlog.com',
            'password'          => 'admin123',
            'type'              => 2,
            'email_verified_at' => Carbon::now()
        ],
        [
            'name'              => 'Ma. Raym Trabajo',
            'email'             => 'faculty_GU@qlog.com',
            'password'          => 'admin123',
            'type'              => 2,
            'email_verified_at' => Carbon::now()
        ],
        [
            'name'              => 'Josephine Aplacador',
            'email'             => 'faculty_SS@qlog.com',
            'password'          => 'admin123',
            'type'              => 2,
            'email_verified_at' => Carbon::now()
        ],
        [
            'name'              => 'Angelica Lanoy',
            'email'             => 'faculty_SC@qlog.com',
            'password'          => 'admin123',
            'type'              => 2,
            'email_verified_at' => Carbon::now()
        ],
        [
            'name'              => 'Damilyn Samijon',
            'email'             => 'faculty_PRES@qlog.com',
            'password'          => 'admin123',
            'type'              => 2,
            'email_verified_at' => Carbon::now()
        ],
        [
            'name'              => 'Josue Basio',
            'email'             => 'faculty_BO@qlog.com',
            'password'          => 'admin123',
            'type'              => 2,
            'email_verified_at' => Carbon::now()
        ],
        [
            'name'              => 'Jasmin Sumipo',
            'email'             => 'faculty_PR01@qlog.com',
            'password'          => 'admin123',
            'type'              => 2,
            'email_verified_at' => Carbon::now()
        ],
        [
            'name'              => 'Pedro Aplacador',
            'email'             => 'faculty_CMO@qlog.com',
            'password'          => 'admin123',
            'type'              => 2,
            'email_verified_at' => Carbon::now()
        ],
        [
            'name'              => 'Sheila Asubar',
            'email'             => 'faculty_NU@qlog.com',
            'password'          => 'admin123',
            'type'              => 2,
            'email_verified_at' => Carbon::now()
        ],
    ],

    'facilities' => 
    [
        'Dianne Sab Gastanes'       => [
            'name'                  => 'Finance Office',
            'code'                  => 'FI',
        ],
        'Jose Ruel Alampayan'       => [
            'name'                  => 'Registrar Office',
            'code'                  => 'RE',
        ],
        'Ma. Raym Trabajo'          => [
            'name'                  => 'Guidance Office',
            'code'                  => 'GU',
        ],
        'Josephine Aplacador'       => [
            'name'                  => 'SSG Office',
            'code'                  => 'SSG',
        ],
        'Angelica Lanoy'            => [
            'name'                  => 'Scholarship Office',
            'code'                  => 'SC',
        ],
        'Damilyn Samijon'           => [
            'name'                  => 'President’s Office',
            'code'                  => 'PRES',
        ],
        'Josue Basio'               => [
            'name'                  => 'Bookstore',
            'code'                  => 'BO',
        ],
        'Jasmin Sumipo'             => [
            'name'                  => 'Principal’s Office - Highschool',
            'code'                  => 'PR-H',
        ],
        'Pedro Aplacador'           => [
            'name'                  => 'Campus Ministry Office',
            'code'                  => 'CMO',
        ],
        'Sheila Asubar'             => [
            'name'                  => 'Nurse Office',
            'code'                  => 'NU',
        ],
    ]
];