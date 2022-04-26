<?php

return [
    // User Logs
    [
        'name' => 'user_logs.viewAny',
        'label' => 'Menu - User Logs',
        'admin_redirect' => '/user_logs',
        'casl' => [
            'action' => 'read',
            'subject' => 'UserLog',
        ],
    ],
    // Transfer Logs
    [
        'name' => 'transfer_logs.viewAny',
        'label' => 'Menu - Transfer Logs',
        'admin_redirect' => '/transfer_logs',
        'casl' => [
            'action' => 'read',
            'subject' => 'TransferLog',
        ],
    ],
];
