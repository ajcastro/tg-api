<?php

return [
    // Menu - Market List
    [
        'name' => 'markets.viewAny',
        'label' => 'Menu - Market List',
        'admin_redirect' => '/markets/list',
        'casl' => [
            'action' => 'read',
            'subject' => 'Market',
        ],
    ],
    // Menu - Market Websites
    [
        'name' => 'markets.websites',
        'label' => 'Menu - Market Websites',
        'admin_redirect' => '/markets/websites',
        'casl' => [
            'action' => 'read',
            'subject' => 'MarketWebsite',
        ],
    ],
];
