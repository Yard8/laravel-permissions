<?php

namespace Yard8\LaravelPermissions\Traits;

use Illuminate\Support\Str;
use Yard8\LaravelPermissions\Models\Permission;
use Yard8\LaravelPermissions\Models\Role;

trait HasPermissions
{
    /**
     * Check if a user has a specific permission assigned to them.
     *
     * @param  string  $permission
     * @return  boolean
     */
    public function hasPermission($permission)
    {
        if ($this->hasRole(config('permissions.admin'))) {
            return true;
        }

        $permissions = $this->permissions->pluck('id')->toArray();

        return in_array($permission, $permissions);
    }

    /**
     * Check if a user has any of the permissions assigned to them.
     *
     * @param  array  $permissions
     * @return  boolean
     */
    public function hasAnyPermission($permissions)
    {
        if ($this->hasRole(config('permissions.admin'))) {
            return true;
        }

        $assignedPermissions = $this->permissions->pluck('id')->toArray();

        foreach ($permissions as $permission) {
            if (in_array($permission, $assignedPermissions)) {
                return true;
            }
        }

        return false;
    }

    /**
     * Check if a user has has one of the roles assigned to them.
     *
     * @param  string|array  $roles
     * @return  boolean
     */
    public function hasRole($roles)
    {
        if (is_null($this->role)) {
            return false;
        }

        $role = Str::slug($this->role->name);

        if (is_array($roles)) {
            return in_array($role, $roles);
        }

        return $role === $roles;
    }

    /**
     * Get the permissions assigned to the user.
     */
    public function permissions()
    {
        return $this->belongsToMany(Permission::class);
    }

    /**
     * Get the role assigned to the user.
     */
    public function role()
    {
        return $this->belongsTo(Role::class);
    }
}
