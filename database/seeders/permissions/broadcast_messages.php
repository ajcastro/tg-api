<?php

return [
    // Menu - Dashboard
    [
        'name' => 'broadcast_message',
        'label' => 'Action - Broadcast Message',
        'admin_redirect' => '/dashboard',
        'casl' => [
            'action' => 'broadcast',
            'subject' => 'BroadcastMessage',
        ],
    ],

];
