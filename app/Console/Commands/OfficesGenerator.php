<?php

namespace App\Console\Commands;

use App\Models\Role;
use App\Models\User;
use App\Models\UserRole;
use Illuminate\Console\Command;

class OfficesGenerator extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'generate:offices';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    public function officeHead()
    {
        return config('offices.head');
    }

    public function facilities($name)
    {
        $facilitiesHead = config('offices.facilities');

        return $facilitiesHead[$name];
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $bar = $this->output->createProgressBar(count($this->officeHead()));

        $bar->start();
        Role::updateOrCreate([
            ['role'          =>  'office-head'],
            'description'   => 'For head of the offices'
        ]);
        $role = Role::where('role', 'office-head')->select('id')->first();
        foreach ($this->officeHead() as $head) {
            $user = User::search($head['name'])->select('id', 'fname', 'lname')->first();
            if ($user) {
                UserRole::create(['user_id' => $user->id, 'role_id' => $role->id]);
                if ($user->office()) {
                    $user->office()->updateOrCreate(
                        ['user_id' => $user->id],
                        $this->facilities($user->fname . ' ' . $user->lname)
                    );
                }
                $bar->advance();
            }
        }

        $bar->finish();

        $this->newLine();
        $this->info('The command was successful!');
    }
}
