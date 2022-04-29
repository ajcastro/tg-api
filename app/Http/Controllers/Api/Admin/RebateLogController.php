<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\PaginateOrListResource;
use App\Http\Queries\RebateLogQuery;
use App\Models\UserLog;

class RebateLogController extends Controller
{
    use PaginateOrListResource;

    public function __construct()
    {
        $this->hook(function () {
            $this->query = new RebateLogQuery;
        })->only(['index']);

        $this->hook(function ($request) {
            UserLog::fromRequest($request)
                ->fill([
                    'category' => 'REBATE',
                    'activity' => 'View Rebate Logs',
                ])
                ->save();
        })->only(['index']);
    }
}
