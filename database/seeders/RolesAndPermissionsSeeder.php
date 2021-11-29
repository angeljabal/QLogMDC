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

        $arrayOfPermissionNames = [
            'manage users', 'view its facility', 'manage purposes', 'manage queue', 'view logs', 'scan qr'
        ];

        $permissions = collect($arrayOfPermissionNames)->map(function ($permission) {
            return ['name' => $permission, 'guard_name' => 'web'];
        });

        Permission::insert($permissions->toArray());

        Role::create(['name' => 'admin'])
            ->givePermissionTo(Permission::all());     
        
        Role::create(['name' => 'head'])->givePermissionTo(['view its facility', 'manage purposes', 'manage queue', 'view logs', 'scan qr']);
        Role::create(['name' => 'faculty'])->givePermissionTo(['scan qr']);
        Role::create(['name' => 'user']);
    }
}
