<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\PaginateOrListResource;
use App\Http\Queries\ReferralLogQuery;
use App\Models\ReferralLog;
use Illuminate\Http\Resources\Json\JsonResource;

class ReferralLogController extends Controller
{
    use PaginateOrListResource;

    public function __construct()
    {
        $this->hook(function () {
            $this->query = new ReferralLogQuery;
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
