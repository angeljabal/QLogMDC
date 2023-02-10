<?php

namespace App\Permissions;

use App\Permission;
use App\Role;

trait HasPermissionsTrait
{
    public function hasRole(...$roles)
    {

        foreach ($roles as $role) {
            if ($this->roles->contains('role', $role)) {
                return true;
            }
        }
        return false;
    }
    public function roles()
    {

        return $this->belongsToMany(Role::class, 'user_roles');
    }
}