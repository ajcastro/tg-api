<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\PaginateOrListResource;
use App\Http\Controllers\Traits\ResolvesModel;
use App\Http\Controllers\Traits\ResolvesRequest;
use App\Http\Controllers\Traits\ShowResource;
use App\Http\Queries\PermissionQuery;
use App\Models\Permission;

class PermissionController extends Controller
{
    use ResolvesModel;
    use ResolvesRequest;
    use PaginateOrListResource;
    use ShowResource;

    public function __construct()
    {
        $this->hook(function () {
            $this->model = Permission::class;
        });

        $this->hook(function () {
            $this->query = new PermissionQuery;
        })->only(['index', 'show']);
    }
}
