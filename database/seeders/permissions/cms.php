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
            'subject' => 'ContactSetting',
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
    [
        'name' => 'contact_settings.set_active',
        'label' => 'Action - Activate Contact Setting',
        'casl' => [
            'action' => 'activate',
            'subject' => 'ContactSetting',
        ],
    ],
    [
        'name' => 'contact_settings.set_inactive',
        'label' => 'Action - Deactivate Contact Setting',
        'casl' => [
            'action' => 'deactivate',
            'subject' => 'ContactSetting',
        ],
    ],
    // Guide Lists
    [
        'name' => 'guide_lists.read',
        'label' => 'Menu - Guide Lists',
        'admin_redirect' => '/guide_lists',
        'casl' => [
            'action' => 'read',
            'subject' => 'GuideList',
        ],
    ],
    [
        'name' => 'guide_lists.create',
        'label' => 'Action - Create Guide List',
        'casl' => [
            'action' => 'create',
            'subject' => 'GuideList',
        ],
    ],
    [
        'name' => 'guide_lists.update',
        'label' => 'Action - Update Guide List',
        'casl' => [
            'action' => 'update',
            'subject' => 'GuideList',
        ],
    ],
    [
        'name' => 'guide_lists.set_active',
        'label' => 'Action - Activate Guide List',
        'casl' => [
            'action' => 'activate',
            'subject' => 'GuideList',
        ],
    ],
    [
        'name' => 'guide_lists.set_inactive',
        'label' => 'Action - Deactivate Guide List',
        'casl' => [
            'action' => 'deactivate',
            'subject' => 'GuideList',
        ],
    ],
    // Guide Contents
    [
        'name' => 'guide_contents.read',
        'label' => 'Menu - Guide Contents',
        'admin_redirect' => '/guide_contents',
        'casl' => [
            'action' => 'read',
            'subject' => 'GuideContent',
        ],
    ],
    [
        'name' => 'guide_contents.update',
        'label' => 'Action - Update Guide List',
        'casl' => [
            'action' => 'update',
            'subject' => 'GuideContent',
        ],
    ],
    [
        'name' => 'guide_contents.set_active',
        'label' => 'Action - Activate Guide List',
        'casl' => [
            'action' => 'activate',
            'subject' => 'GuideContent',
        ],
    ],
    [
        'name' => 'guide_contents.set_inactive',
        'label' => 'Action - Deactivate Guide List',
        'casl' => [
            'action' => 'deactivate',
            'subject' => 'GuideContent',
        ],
    ],
];
