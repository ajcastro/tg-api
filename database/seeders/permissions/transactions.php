<?php

return [
    // New Deposits
    [
        'name' => 'transactions.new_deposits.view',
        'label' => 'Menu - New Deposits',
        'admin_redirect' => '/transactions/new_deposits',
        'casl' => [
            'action' => 'read_new_deposits',
            'subject' => 'MemberTransaction',
        ],
    ],
    [
        'name' => 'transactions.new_deposits.approve',
        'label' => 'Action - New Deposits - Approve',
        'casl' => [
            'action' => 'approve_new_deposits',
            'subject' => 'MemberTransaction',
        ],
    ],
    [
        'name' => 'transactions.new_deposits.reject',
        'label' => 'Action - New Deposits - Reject',
        'casl' => [
            'action' => 'reject_new_deposits',
            'subject' => 'MemberTransaction',
        ],
    ],
    [
        'name' => 'transactions.new_deposits.enter_remarks',
        'label' => 'Action - New Deposits - Enter Remarks',
        'casl' => [
            'action' => 'enter_remarks_new_deposits',
            'subject' => 'MemberTransaction',
        ],
    ],

    // Deposit List
    [
        'name' => 'transactions.deposit_list.view',
        'label' => 'Menu - Deposit List',
        'admin_redirect' => '/transactions/deposit_list',
        'casl' => [
            'action' => 'read_new_withdrawals',
            'subject' => 'MemberTransaction',
        ],
    ],
    [
        'name' => 'transactions.deposit_list.cancel',
        'label' => 'Action - Deposit List - Cancel',
        'casl' => [
            'action' => 'cancel_deposit_list',
            'subject' => 'MemberTransaction',
        ],
    ],
    [
        'name' => 'transactions.deposit_list.enter_remarks',
        'label' => 'Action - Deposit List - Enter Remarks',
        'casl' => [
            'action' => 'enter_remarks_deposit_list',
            'subject' => 'MemberTransaction',
        ],
    ],

    // New Withdrawals
    [
        'name' => 'transactions.new_withdrawals.view',
        'label' => 'Menu - New Withdrawals',
        'admin_redirect' => '/transactions/new_withdrawals',
        'casl' => [
            'action' => 'read_new_withdrawals',
            'subject' => 'MemberTransaction',
        ],
    ],
    [
        'name' => 'transactions.new_withdrawals.approve',
        'label' => 'Action - New Withdrawals - Approve',
        'casl' => [
            'action' => 'approve_new_withdrawals',
            'subject' => 'MemberTransaction',
        ],
    ],
    [
        'name' => 'transactions.new_withdrawals.reject',
        'label' => 'Action - New Withdrawals - Reject',
        'casl' => [
            'action' => 'reject_new_withdrawals',
            'subject' => 'MemberTransaction',
        ],
    ],
    [
        'name' => 'transactions.new_withdrawals.enter_remarks',
        'label' => 'Action - New Withdrawals - Enter Remarks',
        'casl' => [
            'action' => 'enter_remarks_new_withdrawals',
            'subject' => 'MemberTransaction',
        ],
    ],

    // Withdrawal List
    [
        'name' => 'transactions.withdrawal_list.view',
        'label' => 'Menu - Withdrawal List',
        'admin_redirect' => '/transactions/withdrawal_list',
        'casl' => [
            'action' => 'read_withdrawal_list',
            'subject' => 'MemberTransaction',
        ],
    ],
    [
        'name' => 'transactions.withdrawal_list.cancel',
        'label' => 'Action - Withdrawal List - Cancel',
        'casl' => [
            'action' => 'cancel_withdrawal_list',
            'subject' => 'MemberTransaction',
        ],
    ],
    [
        'name' => 'transactions.withdrawal_list.enter_remarks',
        'label' => 'Action - Withdrawal List - Enter Remarks',
        'casl' => [
            'action' => 'enter_remarks_withdrawal_list',
            'subject' => 'MemberTransaction',
        ],
    ],

    // Adjustments
    [
        'name' => 'transactions.adjustments.view',
        'label' => 'Menu - Adjustments',
        'admin_redirect' => '/transactions/adjustments',
        'casl' => [
            'action' => 'read_adjustments',
            'subject' => 'MemberTransaction',
        ],
    ],
    [
        'name' => 'transactions.adjustments.create',
        'label' => 'Action - Adjustments - Create',
        'casl' => [
            'action' => 'create_adjustments',
            'subject' => 'MemberTransaction',
        ],
    ],
    [
        'name' => 'transactions.adjustments.approve',
        'label' => 'Action - Adjustments - Approve',
        'casl' => [
            'action' => 'approve_adjustments',
            'subject' => 'MemberTransaction',
        ],
    ],
    [
        'name' => 'transactions.adjustments.reject',
        'label' => 'Action - Adjustments - Reject',
        'casl' => [
            'action' => 'reject_adjustments',
            'subject' => 'MemberTransaction',
        ],
    ],
    [
        'name' => 'transactions.adjustments.enter_remarks',
        'label' => 'Action - Adjustments - Enter Remarks',
        'casl' => [
            'action' => 'enter_remarks_adjustments',
            'subject' => 'MemberTransaction',
        ],
    ],
];
