<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Admin
    |--------------------------------------------------------------------------
    |
    | This value is the name of the role given to the administrator
    | of the application who will be granted all permissions.
    |
     */
    'admin' => 'admin',

    /*
    |--------------------------------------------------------------------------
    | Roles
    |--------------------------------------------------------------------------
    |
    | This array defines all the roles your application will have
    | starting with the main administrator role that will have the
    | permissions to do everything and working its way down the
    | hierarchy.
    |
     */
    'roles' => [
        [
            'name'        => 'admin',
            'description' => 'Manages all aspects of the site.',
        ],
        [
            'name'        => 'blogger',
            'description' => 'Is allowed to create posts.',
        ],
        [
            'name'        => 'guest',
            'description' => 'Can comment and read posts.',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Permissions
    |--------------------------------------------------------------------------
    |
    | This array defines all the permissions your application will
    | make use of and groups up similar or related permissions.
    |
     */
    'permissions' => [
        'posts' => [
            'see-posts',
            'create-post',
            'edit-post',
        ],
        'comments' => [
            'can-comment',
            'delete-comments',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Permissions per Role
    |--------------------------------------------------------------------------
    |
    | This array defines all the permissions that will be assigned
    | to the specific role by default.
    |
     */
    'defaults' => [
        'admin' => [
            'see-posts',
            'create-post',
            'edit-post',
            'can-comment',
            'delete-comments',
        ],
        'blogger' => [
            'see-posts',
            'create-post',
            'edit-post',
            'can-comment',
        ],
        'guest' => [
            'see-posts',
            'can-comment',
        ],
    ],
];
