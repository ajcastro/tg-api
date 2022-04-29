<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\PaginateOrListResource;
use App\Http\Queries\ReferralLogQuery;
use App\Models\ReferralLog;
use App\Models\UserLog;
use Illuminate\Http\Resources\Json\JsonResource;

class ReferralLogController extends Controller
{
    use PaginateOrListResource;

    public function __construct()
    {
        $this->hook(function () {
            $this->query = new ReferralLogQuery;
        })->only(['index']);

        $this->hook(function ($request) {
            UserLog::fromRequest($request)
                ->fill([
                    'category' => 'REFERRAL',
                    'activity' => 'View Referral Logs',
                ])
                ->save();
        })->only(['index']);
    }

    public function show(ReferralLog $referralLog)
    {
        $referralLog->load([
            'member',
            'details.downlinkMember',
            'details.gameCategory',
        ]);

        return JsonResource::make($referralLog);
    }
}
