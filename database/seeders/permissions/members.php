<?php

return [
    // Member List
    [
        'name' => 'members.view_member_list',
        'label' => 'Menu - Member List',
        'admin_redirect' => '/members/list',
        'casl' => [
            'action' => 'read',
            'subject' => 'Member',
        ],
    ],
    [
        'name' => 'members.view_detail',
        'label' => 'Action - Member List - View Member Detail',
        'casl' => [
            'action' => 'view_detail',
            'subject' => 'Member',
        ],
    ],
    [
        'name' => 'members.update',
        'label' => 'Action - Member List - Update Member',
        'casl' => [
            'action' => 'update',
            'subject' => 'Member',
        ],
    ],
    [
        'name' => 'members.change_password',
        'label' => 'Action - Member List - Member Change Password',
        'casl' => [
            'action' => 'change_password',
            'subject' => 'Member',
        ],
    ],
    [
        'name' => 'members.suspend',
        'label' => 'Action - Member List - Suspend Member',
        'casl' => [
            'action' => 'suspend',
            'subject' => 'Member',
        ],
    ],
    [
        'name' => 'members.remove_suspension',
        'label' => 'Action - Member List - Remove Suspension',
        'casl' => [
            'action' => 'remove_suspension',
            'subject' => 'Member',
        ],
    ],
    [
        'name' => 'members.blacklist',
        'label' => 'Action - Member List - Blacklist Member',
        'casl' => [
            'action' => 'blacklist',
            'subject' => 'Member',
        ],
    ],

    // Member Online
    [
        'name' => 'members.view_member_online',
        'label' => 'Menu - Member Online',
        'admin_redirect' => '/members/online',
        'casl' => [
            'action' => 'read_online',
            'subject' => 'Member',
        ],
    ],
    [
        'name' => 'members.kick_member',
        'label' => 'Action - Member Online - Kick',
        'casl' => [
            'action' => 'kick_member',
            'subject' => 'Member',
        ],
    ],
    [
        'name' => 'members.kick_all_members',
        'label' => 'Action - Member Online - Kick All Members',
        'casl' => [
            'action' => 'kick_all_members',
            'subject' => 'Member',
        ],
    ],

    // Referral List
    [
        'name' => 'members.view_referral_list',
        'label' => 'Menu - Referral List',
        'admin_redirect' => '/members/online',
        'casl' => [
            'action' => 'read_referrrals',
            'subject' => 'Member',
        ],
    ],

    // Blacklist
    [
        'name' => 'members.view_blacklist',
        'label' => 'Menu - Blacklist',
        'admin_redirect' => '/members/blacklist',
        'casl' => [
            'action' => 'read_blacklist',
            'subject' => 'Member',
        ],
    ],
];
