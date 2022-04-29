<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\ResourceController;
use App\Http\Queries\MemberQuery;
use App\Http\UserLogAttributes\MemberUserLog;
use App\Models\Member;
use App\Models\UserLog;
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

        $this->hook(function (Request $request) {
            $record = $this->resolveRecord($request);

            UserLog::fromRequest($request)
                ->fill([
                    'website_id' => $record->website_id,
                    'member_id' => $record->id,
                    'category' => 'MEMBER',
                    'activity' => 'View Member',
                    'detail' => "#{$record->id}, {$record->username}",
                ])
                ->save();
        })->only(['show']);

        $this->hook(function (Request $request) {
            $record = $this->resolveRecord($request);

            UserLog::fromRequest($request)
                ->fill([
                    'website_id' => $record->website_id,
                    'member_id' => $record->id,
                    'category' => 'MEMBER',
                    'activity' => 'Suspend Member',
                    'detail' => "#{$record->id}, {$record->username}",
                ])
                ->save();
        })->only(['suspend']);

        $this->hook(function (Request $request) {
            $record = $this->resolveRecord($request);

            UserLog::fromRequest($request)
                ->fill([
                    'website_id' => $record->website_id,
                    'member_id' => $record->id,
                    'category' => 'MEMBER',
                    'activity' => 'Blacklist Member',
                    'detail' => "#{$record->id}, {$record->username}",
                ])
                ->save();
        })->only(['blacklist']);

        $this->hook(function (Request $request) {
            $record = $this->resolveRecord($request);

            UserLog::fromRequest($request)
                ->fill([
                    'website_id' => $record->website_id,
                    'member_id' => $record->id,
                    'category' => 'MEMBER',
                    'activity' => 'Blacklist Member',
                    'detail' => "#{$record->id}, {$record->username}",
                ])
                ->save();
        })->only(['blacklist']);

        $this->hook(function (Request $request) {
            $record = $this->resolveRecord($request);

            UserLog::fromRequest($request)
                ->fill([
                    'website_id' => $record->website_id,
                    'member_id' => $record->id,
                    'category' => 'MEMBER',
                    'activity' => 'Remove Suspension',
                    'detail' => "#{$record->id}, {$record->username}",
                ])
                ->save();
        })->only(['removeSuspension']);

        $this->hook(function (Request $request) {
            $record = $this->resolveRecord($request);

            UserLog::fromRequest($request)
                ->fill([
                    'website_id' => $record->website_id,
                    'member_id' => $record->id,
                    'category' => 'MEMBER',
                    'activity' => 'Kick Member',
                    'detail' => "#{$record->id}, {$record->username}",
                ])
                ->save();
        })->only(['kick']);
    }

    protected function resolveRecord(Request $request)
    {
        return $this->getRecord($request->route('member'));
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

    public function kick(Member $member)
    {
        $activeLog = $member->activeLog;
        $activeLog->kicked_at = now();
        $activeLog->save();
    }

    public function kickAll()
    {
        Member::kickAll();
    }
}
