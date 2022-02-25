<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\ResourceController;
use App\Http\Queries\MemberQuery;
use App\Models\Member;
use Illuminate\Http\Request;

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

    public function suspend(Request $request, Member $member)
    {
        $request->validate([
            'reason' => 'required',
        ]);

        $member->suspend($request->reason);
    }

    public function blacklist(Request $request, Member $member)
    {
        $request->validate([
            'reason' => 'required',
        ]);

        $member->blacklist($request->reason);
    }

    public function removeSuspension(Request $request, Member $member)
    {
        $member->removeSuspension();
    }
}
