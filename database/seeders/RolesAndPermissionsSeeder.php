<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        Permission::create(['name' => 'scan qr']);
        Role::create(['name' => 'admin'])->givePermissionTo(Permission::all());     
        
        Role::create(['name' => 'head']);
        Role::create(['name' => 'scanner'])->givePermissionTo(['scan qr']);
        Role::create(['name' => 'user']);
    }
}
