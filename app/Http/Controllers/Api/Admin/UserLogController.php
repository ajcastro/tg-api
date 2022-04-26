<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\PaginateOrListResource;
use App\Http\Queries\UserLogQuery;
use App\Models\UserLog;
use Illuminate\Http\Resources\Json\JsonResource;

class UserLogController extends Controller
{
    use PaginateOrListResource;

    public function __construct()
    {
        $this->hook(function () {
            $this->query = new UserLogQuery;
        })->only(['index']);
    }

    public function show(UserLog $transferLog)
    {
        $transferLog->load([
            'member',
        ]);

        return JsonResource::make($transferLog);
    }
}
