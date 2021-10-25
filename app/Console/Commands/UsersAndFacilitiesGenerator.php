<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;

class UsersAndFacilitiesGenerator extends Command
{
    
    /**
     * USER's ROLE
     */
    const USER  = 1;
    const ADMIN     = 2;
    const HEAD      = 3;
    const FACULTY   = 3;
    /**
     * USER's TYPE
     */
    const STUDENT   = 1;
    const STAFF     = 2;
    const VISITOR   = 3;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'generate:faculties';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate users with facilities';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    public function facultyHead()
    {
        $head = [
            [
                'name'          => 'Alvin Gwapo',
                'email'         => 'admin@admin.com',
                'password'      => Hash::make('password'),
                'type'          => self::STAFF,
                'role'          => self::ADMIN,
            ],
            [
                'name'          => 'Angel Gwapa',
                'email'         => 'admin2@admin.com',
                'password'      => Hash::make('password'),
                'type'          => self::STAFF,
                'role'          => self::ADMIN,
            ],
        ];
        return $head;
    }
    public function facilities($name)
    {
        $facilitiesHead = [
            'Alvin Gwapo' => [
                'name'          => 'College of Accountancy, Business, and Manangement - Business Department',
                'code'          => 'CAB',
                'building'      => 'College Building',
            ],
            'Angel Gwapa' => [
                'name'          => 'College of Arts, Sciences, and Technology',
                'code'          => 'CA',
                'building'      => 'College Building',
            ]
        ];

        return $facilitiesHead[$name];
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {

        $bar = $this->output->createProgressBar(count($this->facultyHead()));
        
        $bar->start();

        foreach($this->facultyHead() as $head)
        {
            $user = User::updateOrCreate(
                ['email' => $head['email']],
                $head
            );
            $user->facility()->updateOrCreate(
                ['user_id' => $user->id],
                $this->facilities($user->name));
            $bar->advance();
        }

        $bar->finish();

        $this->newLine();
        $this->info('The command was successful!');
    }
}
