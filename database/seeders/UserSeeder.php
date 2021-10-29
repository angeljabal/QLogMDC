<?php

namespace Database\Seeders;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::factory()->hasProfile()->create([
                'name'              => 'QLOG Admin',
                'email'             => 'admin@admin.com',
                'password'          => Hash::make('admin123'),
                'type'              => 2,
                'email_verified_at' => Carbon::now()
        ])->assignRole('admin');

        $users = User::factory(50)
                    ->hasProfile()
                    ->create();

        $role = Role::findByName('user');
        $role->users()->attach($users);

    }
}
