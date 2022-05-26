<?php

return [
    [
        'name' => 'profit_loss.view',
        'label' => 'Menu - P/L',
        'admin_redirect' => '/profit_loss',
        'casl' => [
            'action' => 'read',
            'subject' => 'ProfitLoss',
        ],
    ],
    [
        'name' => 'profit_loss_by_members.view',
        'label' => 'Menu - P/L by Member',
        'admin_redirect' => '/profit_loss_by_member',
        'casl' => [
            'action' => 'read',
            'subject' => 'ProfitLossByMember',
        ],
    ],
];
