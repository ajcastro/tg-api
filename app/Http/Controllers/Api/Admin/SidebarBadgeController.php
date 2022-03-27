<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SidebarBadgeController extends Controller
{
    public function list()
    {
        return [
            'new_deposits' => 10,
            'new_withdrawals' => 10,
        ];
    }
}
