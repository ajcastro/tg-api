<?php

return [
    // Website Settings
    [
        'name' => 'website_settings.read',
        'label' => 'Menu - Website Settings',
        'admin_redirect' => '/website_settings',
        'casl' => [
            'action' => 'read',
            'subject' => 'WebsiteSetting',
        ],
    ],
    // Page Contents
    [
        'name' => 'page_contents.read',
        'label' => 'Menu - Page Contents',
        'admin_redirect' => '/page_contents',
        'casl' => [
            'action' => 'read',
            'subject' => 'PageContent',
        ],
    ],
    [
        'name' => 'page_contents.create',
        'label' => 'Action - Create Page Content',
        'casl' => [
            'action' => 'create',
            'subject' => 'PageContent',
        ],
    ],
    [
        'name' => 'page_contents.update',
        'label' => 'Action - Update Page Content',
        'casl' => [
            'action' => 'update',
            'subject' => 'PageContent',
        ],
    ],
    // Contact Settings
    [
        'name' => 'contact_settings.read',
        'label' => 'Menu - Contact Settings',
        'admin_redirect' => '/contact_settings',
        'casl' => [
            'action' => 'read',
            'subject' => 'ContactSetting',
        ],
    ],
    [
        'name' => 'contact_settings.create',
        'label' => 'Action - Create Contact Setting',
        'casl' => [
            'action' => 'create',
            'subject' => 'PageContent',
        ],
    ],
    [
        'name' => 'contact_settings.update',
        'label' => 'Action - Update Contact Setting',
        'casl' => [
            'action' => 'update',
            'subject' => 'ContactSetting',
        ],
    ],
];
