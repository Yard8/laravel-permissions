<?php

namespace Yard8\LaravelPermissions\Console;


use Yard8\LaravelPermissions\Models\Permission;
use Yard8\LaravelPermissions\Models\Role;
use Illuminate\Console\Command;

class InsertRolesAndPermissions extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'laravel-permissions:insert';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Insert all the roles and permissions into the database.';

    /**
     * Execute the console command.
     *
     * @return void
     */
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
