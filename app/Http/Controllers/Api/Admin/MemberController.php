<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\ResourceController;
use App\Http\Queries\MemberQuery;
use App\Models\Member;

class MemberController extends ResourceController
{
    public function __construct()
    {
        $this->hook(function () {
            $this->model = Member::class;
        });

        $this->hook(function () {
            $this->query = new MemberQuery;
        })->only(['index', 'show']);
    }
}
