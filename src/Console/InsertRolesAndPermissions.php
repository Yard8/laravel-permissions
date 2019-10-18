<?php

namespace Yard8\LaravelPermissions\Console;


use Yard8\LaravelPermissions\Models\Permission;
use Yard8\LaravelPermissions\Models\Role;
use Illuminate\Console\Command;

class InsertRolesAndPermissions extends Command
{
    protected $signature = 'laravel-permissions:insert';

    protected $description = 'Insert all the roles and permissions into the database.';

    public function handle()
    {
        $this->info('Inserting roles...');

        $roles = config('permissions.roles');

        Role::insert($roles);

        $this->info('Inserting permissions...');

        $permissions = [];
        $permissionsByGroup = config('permissions.permissions');

        foreach ($permissionsByGroup as $group => $groupOfPermissions) {
            foreach ($groupOfPermissions as $permission) {
                $permissions[] = [
                    'id' => $permission,
                    'group' => $group
                ];
            }
        }

        Permission::insert($permissions);

        $this->info('Inserting defaults for each role...');

        $allRoles = Role::all();
        $allPermissions = Permission::all();
        $defaultPermissions = config('permissions.defaults');

        foreach ($defaultPermissions as $roleName => $permissionsForRole) {
            $role = $allRoles->where('name', $roleName)->first();

            if ($role) {
                $permissionsToSync = $allPermissions->find($permissionsForRole);
                $role->sync($permissionsToSync);
            }
        }

        $this->info('Inserts complete!');
    }
}
