# Laravel Permissions

[![Latest Version on Packagist](https://img.shields.io/packagist/v/yard8/laravel-permissions.svg?style=flat-square)](https://packagist.org/packages/yard8/laravel-permissions)
[![Build Status](https://img.shields.io/travis/yard8/laravel-permissions/master.svg?style=flat-square)](https://travis-ci.org/yard8/laravel-permissions)
[![Quality Score](https://img.shields.io/scrutinizer/g/yard8/laravel-permissions.svg?style=flat-square)](https://scrutinizer-ci.com/g/yard8/laravel-permissions)
[![Total Downloads](https://img.shields.io/packagist/dt/yard8/laravel-permissions.svg?style=flat-square)](https://packagist.org/packages/yard8/laravel-permissions)

The purpose of this package is to create both roles and permissions which could be assigned to a user and used during authorisation or policy checks.

## Installation

You can install the package via composer:

```bash
composer require yard8/laravel-permissions
```

Publish the config and migration files:

```bash
php artisan laravel-permissions:install
```

Add on a `role_id` column which is an `unsigned bigInteger` to the users table which will be related to both the roles and permissions:

Setup the config permissions.php to include the roles and permissions you want in your application.

Insert the roles and permissions into your database:

```bash
php artisan laravel-permissions:insert
```

Add the HasPermissions trait to the model you want to have the roles and permissions:

``` php
<?php

namespace App;

use Yard8\LaravelPermissions\Traits\HasPermissions;

class User extends Authenticatable
{
    use HasPermissions;
}
```

## Usage

``` php
// Assign the authenticated user to a variable.
$user = auth()->user();

// Get the role of the user.
$role = $user->role;

// If the user is granted the role admin, both will return true. If the user has neither of these roles they will both return false.
$isAdmin = $user->hasRole('admin');
$isAdminOrManager = $user->hasRole(['admin', 'manager']);

// Get the permissions of the user.
$permissions = $user->permissions;

// If the user has the permission can-post, both will return true. If the user has neither of these permissions, they will both return false.
$canPost = $user->hasPermission('can-post');
$canPostOrComment = $user->hasAnyPermission(['can-post', 'can-comment']);
```

### Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

### Security

If you discover any security related issues, please email jason@yard8.co.za instead of using the issue tracker.

## Credits

- [Jason Hodkinson](https://github.com/yard8)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

## Laravel Package Boilerplate

This package was generated using the [Laravel Package Boilerplate](https://laravelpackageboilerplate.com).
