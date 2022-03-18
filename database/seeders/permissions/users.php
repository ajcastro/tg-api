<?php

return [
    // Users
    [
        'name' => 'users.view_any',
        'label' => 'Menu - Users',
        'admin_redirect' => '/users',
        'casl' => [
            'action' => 'read',
            'subject' => 'User',
        ],
    ],
    [
        'name' => 'users.view',
        'label' => 'Action - Users - View User Detail',
        'casl' => [
            'action' => 'view_detail',
            'subject' => 'User',
        ],
    ],
    [
        'name' => 'users.create',
        'label' => 'Action - Users - Create User',
        'casl' => [
            'action' => 'create',
            'subject' => 'User',
        ],
    ],
    [
        'name' => 'users.update',
        'label' => 'Action - Users - Update User',
        'casl' => [
            'action' => 'update',
            'subject' => 'User',
        ],
    ],
    [
        'name' => 'users.set_active',
        'label' => 'Action - Users - Activate User',
        'casl' => [
            'action' => 'activate',
            'subject' => 'User',
        ],
    ],
    [
        'name' => 'users.set_inactive',
        'label' => 'Action - Users - Deactivate User',
        'casl' => [
            'action' => 'deactivate',
            'subject' => 'User',
        ],
    ],
    // Roles
    [
        'name' => 'roles.view_any',
        'label' => 'Menu - Roles',
        'admin_redirect' => '/roles',
        'casl' => [
            'action' => 'read',
            'subject' => 'Role',
        ],
    ],
    [
        'name' => 'roles.update',
        'label' => 'Action - Roles - Edit Roles',
        'casl' => [
            'action' => 'update',
            'subject' => 'Role',
        ],
    ],
    [
        'name' => 'roles.set_permissions',
        'label' => 'Action - Roles - Set Permissions',
        'casl' => [
            'action' => 'set_permissions',
            'subject' => 'Role',
        ],
    ],
    [
        'name' => 'roles.set_active',
        'label' => 'Action - Roles - Activate Role',
        'casl' => [
            'action' => 'activate',
            'subject' => 'Role',
        ],
    ],
    [
        'name' => 'roles.set_inactive',
        'label' => 'Action - Roles - Deactivate Role',
        'casl' => [
            'action' => 'deactivate',
            'subject' => 'Role',
        ],
    ],

    // Parent Groups
    [
        'name' => 'parent_groups.view_any',
        'label' => 'Menu - Parent Groups',
        'admin_redirect' => '/parent_groups',
        'casl' => [
            'action' => 'read',
            'subject' => 'ParentGroup',
        ],
    ],
    [
        'name' => 'parent_groups.view_users',
        'label' => 'Action - Parent Groups - View Users',
        'casl' => [
            'action' => 'view_users',
            'subject' => 'ParentGroup',
        ],
    ],
    [
        'name' => 'parent_groups.view_websites',
        'label' => 'Action - Parent Groups - View Websites',
        'casl' => [
            'action' => 'view_websites',
            'subject' => 'ParentGroup',
        ],
    ],
    [
        'name' => 'parent_groups.set_active',
        'label' => 'Action - Parent Groups - Activate Parent Group',
        'casl' => [
            'action' => 'activate',
            'subject' => 'ParentGroup',
        ],
    ],
    [
        'name' => 'parent_groups.set_inactive',
        'label' => 'Action - Parent Groups - Deactivate Parent Group',
        'casl' => [
            'action' => 'deactivate',
            'subject' => 'ParentGroup',
        ],
    ],
];
