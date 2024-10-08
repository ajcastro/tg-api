<?php

return [
    // Promotion List
    [
        'name' => 'promotions.view_promotion_list',
        'label' => 'Menu - Promotion List',
        'admin_redirect' => '/promotions/list',
        'casl' => [
            'action' => 'read',
            'subject' => 'Promotion',
        ],
    ],
    [
        'name' => 'promotions.create',
        'label' => 'Action - Promotion - Create Promotion',
        'casl' => [
            'action' => 'create',
            'subject' => 'Promotion',
        ],
    ],
    [
        'name' => 'promotions.view_detail',
        'label' => 'Action - Promotion List - Update Promotion',
        'casl' => [
            'action' => 'update',
            'subject' => 'Promotion',
        ],
    ],
    [
        'name' => 'promotion.set_active',
        'label' => 'Action - Promotion - Activate Promotion',
        'casl' => [
            'action' => 'activate',
            'subject' => 'Promotion',
        ],
    ],
    [
        'name' => 'promotion.set_inactive',
        'label' => 'Action - Promotion - Deactivate Promotion',
        'casl' => [
            'action' => 'deactivate',
            'subject' => 'Promotion',
        ],
    ],
    [
        'name' => 'promotion.setting',
        'label' => 'Action - Promotion List - Setting',
        'casl' => [
            'action' => 'setting',
            'subject' => 'Promotion',
        ],
    ],

    // Promotion Summary
    [
        'name' => 'promotion.summary',
        'label' => 'Menu - Promotion Summary',
        'admin_redirect' => '/promotions/summary',
        'casl' => [
            'action' => 'read_summary',
            'subject' => 'Promotion',
        ],
    ],
    // Promotion Release
    [
        'name' => 'promotion.release',
        'label' => 'Menu - Promotion Release',
        'admin_redirect' => '/promotions/release',
        'casl' => [
            'action' => 'read_release',
            'subject' => 'Promotion',
        ],
    ],
    // Manual Bonus
    [
        'name' => 'promotion.manual',
        'label' => 'Menu - Manual Bonus',
        'admin_redirect' => '/promotions/manual',
        'casl' => [
            'action' => 'read_manual',
            'subject' => 'Promotion',
        ],
    ],
    [
        'name' => 'promotions.manual.create',
        'label' => 'Action - Manual Bonus - Create',
        'casl' => [
            'action' => 'create_manual',
            'subject' => 'Promotion',
        ],
    ],
    [
        'name' => 'promotions.manual.approve',
        'label' => 'Action - Manual Bonus - Approve/Reject',
        'casl' => [
            'action' => 'approve_manual',
            'subject' => 'Promotion',
        ],
    ],
    // Rebate Settings
    [
        'name' => 'rebate_settings.read',
        'label' => 'Menu - Rebate Settings',
        'admin_redirect' => '/rebate_settings',
        'casl' => [
            'action' => 'read',
            'subject' => 'RebateSetting',
        ],
    ],
    // Rebate Logs
    [
        'name' => 'rebate_logs.read',
        'label' => 'Menu - Rebate Logs',
        'admin_redirect' => '/rebate_logs',
        'casl' => [
            'action' => 'read',
            'subject' => 'RebateLog',
        ],
    ],
    // Referral Settings
    [
        'name' => 'referral_settings.read',
        'label' => 'Menu - Referral Settings',
        'admin_redirect' => '/referral_settings',
        'casl' => [
            'action' => 'read',
            'subject' => 'ReferralSetting',
        ],
    ],
    // Referral Logs
    [
        'name' => 'referral_logs.read',
        'label' => 'Menu - Referral Logs',
        'admin_redirect' => '/referral_logs',
        'casl' => [
            'action' => 'read',
            'subject' => 'ReferralLog',
        ],
    ],
];
