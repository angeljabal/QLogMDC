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
            'manage profile', 'view logs',
            'manager users', 'view its facility', 'manage purposes',
            'scan qr'
        ];

        $permissions = collect($arrayOfPermissionNames)->map(function ($permission) {
            return ['name' => $permission, 'guard_name' => 'web'];
        });

        Permission::insert($permissions->toArray());

        Role::create(['name' => 'admin'])
            ->givePermissionTo(Permission::all());     
        
        Role::create(['name' => 'user'])->givePermissionTo(['manage profile', 'view logs']);
        Role::create(['name' => 'head'])->givePermissionTo(['view its facility', 'manage purposes', 'scan qr']);
        Role::create(['name' => 'faculty'])->givePermissionTo(['scan qr']);
    }
}
