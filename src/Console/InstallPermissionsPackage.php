<?php

namespace Yard8\LaravelPermissions\Console;

use Illuminate\Console\Command;

class InstallPermissionsPackage extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'laravel-permissions:install';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Install the Laravel Permissions Package.';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        $this->info('Installing Laravel Permissions Package...');

        $this->info('Publishing configuration...');

        $this->call('vendor:publish', [
            '--provider' => "Yard8\LaravelPermissions\LaravelPermissionsServiceProvider",
            '--tag'      => "config",
        ]);

        $this->info('Publishing migrations...');

        $this->call('vendor:publish', [
            '--provider' => "Yard8\LaravelPermissions\LaravelPermissionsServiceProvider",
            '--tag'      => "migrations",
        ]);

        $this->info('Installed Laravel Permissions Package');
    }
}
