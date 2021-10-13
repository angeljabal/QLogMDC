<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
<<<<<<< Updated upstream
        // \App\Models\User::factory(10)->create();
=======
        $this->call(UserSeeder::class);
        $this->call(DepartmentSeeder::class);
        $this->call(ProfileSeeder::class);
        $this->call(FacilitySeeder::class);
        $this->call(PurposeSeeder::class);
>>>>>>> Stashed changes
    }
}
