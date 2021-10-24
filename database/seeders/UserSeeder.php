<?php

namespace Database\Seeders;

use App\Models\Profile;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

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
            'name'      => 'Alvin Gwapo',
            'email'     => 'admin@admin.com',
            'password'  => Hash::make('password'),
            'type'      => 2,
            'role'      => 2, 
        ]);
        User::factory(50)
            ->hasProfile()
            ->create();
    }
}
