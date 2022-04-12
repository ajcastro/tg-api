<?php

return [
    // Menu - Bank Groups
    [
        'name' => 'bank_groups.view_any',
        'label' => 'Menu - Bank Groups',
        'admin_redirect' => '/banks/groups',
        'casl' => [
            'action' => 'read',
            'subject' => 'BankGroup',
        ],
    ],
    // Menu - Bank List
    [
        'name' => 'banks.view_any',
        'label' => 'Menu - Bank List',
        'admin_redirect' => '/banks/list',
        'casl' => [
            'action' => 'read',
            'subject' => 'Bank',
        ],
    ],
    // Menu - Bank Accounts
    [
        'name' => 'company_banks.view_any',
        'label' => 'Menu - Bank Accounts',
        'admin_redirect' => '/banks/accounts',
        'casl' => [
            'action' => 'read',
            'subject' => 'CompanyBank',
        ],
    ],
];
