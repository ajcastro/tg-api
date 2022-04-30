<?php

return [
    // Menu - Bank Groups
    [
        'name' => 'dashboard.view',
        'label' => 'Menu - Dashboard',
        'admin_redirect' => '/dashboard',
        'casl' => [
            'action' => 'view',
            'subject' => 'Dashboard',
        ],
    ],
    [
        'name' => 'dashboard.member_registration_brief',
        'label' => 'Dashboard - Member Registration Brief',
        'admin_redirect' => '/dashboard',
        'casl' => [
            'action' => 'view',
            'subject' => 'MemberRegistrationBrief',
        ],
    ],
    [
        'name' => 'dashboard.revenue_and_new_registration_performance',
        'label' => 'Dashboard - Revenue and New Registration Performance',
        'admin_redirect' => '/dashboard',
        'casl' => [
            'action' => 'view',
            'subject' => 'RevenueAndNewRegistrationPerformance',
        ],
    ],
    [
        'name' => 'dashboard.website_revenue',
        'label' => 'Dashboard - Website Revenue',
        'admin_redirect' => '/dashboard',
        'casl' => [
            'action' => 'view',
            'subject' => 'WebsiteRevenue',
        ],
    ],
];
