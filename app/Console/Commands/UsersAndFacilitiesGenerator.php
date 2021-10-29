<?php

namespace App\Console\Commands;

use App\Models\Profile;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UsersAndFacilitiesGenerator extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'generate:facilities';

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
        return config('facilities.head');
    }

    public function facilities($name)
    {
        $facilitiesHead = config('facilities.facilities');

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
            $head['password'] = Hash::make($head['password']);
            $user = User::updateOrCreate(
                ['email' => $head['email']],
                $head
            );
            $user->assignRole(['head', 'user']);
            $user->profile()->save(new Profile);
            if($user->facility()){
                $user->facility()->updateOrCreate(
                    ['user_id' => $user->id],
                    $this->facilities($user->name)
                );
            }
            $bar->advance();
        }

        $bar->finish();

        $this->newLine();
        $this->info('The command was successful!');
    }
}
