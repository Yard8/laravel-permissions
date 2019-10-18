<?php

namespace Yard8\LaravelPermissions;

use Yard8\LaravelPermissions\Console\InsertRolesAndPermissions;
use Yard8\LaravelPermissions\Console\InstallPermissionsPackage;
use Illuminate\Support\ServiceProvider;

class LaravelPermissionsServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');

        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../config/config.php' => config_path('permissions.php'),
            ], 'config');

            $this->publishes([
                __DIR__ . '/../database/migrations/create_roles_table.php.stub' => database_path('migrations/' . date('Y_m_d_His', time()) . '_create_roles_table.php'),
                __DIR__ . '/../database/migrations/create_permissions_table.php.stub' => database_path('migrations/' . date('Y_m_d_His', time() + 1) . '_create_permissions_table.php'),
                __DIR__ . '/../database/migrations/create_permission_role_table.php.stub' => database_path('migrations/' . date('Y_m_d_His', time() + 2) . '_create_permission_role_table.php'),
                __DIR__ . '/../database/migrations/create_permission_user_table.php.stub' => database_path('migrations/' . date('Y_m_d_His', time() + 3) . '_create_permission_user_table.php'),
            ], 'migrations');

            $this->commands([
                InstallPermissionsPackage::class,
                InsertRolesAndPermissions::class
            ]);
        }
    }

    /**
     * Register the application services.
     */
    public function register()
    {
        // Automatically apply the package configuration
        $this->mergeConfigFrom(__DIR__.'/../config/config.php', 'laravel-permissions');
    }
}
