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

];
