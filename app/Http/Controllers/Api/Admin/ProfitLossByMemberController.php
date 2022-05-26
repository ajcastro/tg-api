<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\PaginateOrListResource;
use App\Http\Queries\ProfitLossByMemberQuery;
use App\Http\Queries\UserLogQuery;
use Illuminate\Http\Resources\Json\JsonResource;

class ProfitLossByMemberController extends Controller
{
    use PaginateOrListResource;

    public function __construct()
    {
        $this->hook(function () {
            $this->query = new ProfitLossByMemberQuery;
        })->only(['index']);
    }
}
