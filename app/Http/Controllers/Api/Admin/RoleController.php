<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\ResourceController;
use App\Http\Controllers\Traits\SetActiveStatus;
use App\Http\Queries\RoleQuery;
use App\Http\Requests\Api\Admin\RoleRequest;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class RoleController extends ResourceController
{
    use SetActiveStatus;

    public function __construct()
    {
        $this->hook(function () {
            $this->model = Role::class;
        });

        $this->hook(function () {
            $this->query = new RoleQuery;
        })->only(['index', 'show']);

        $this->hook(function () {
            $this->request = RoleRequest::class;
        })->only(['store', 'update']);
    }

    public function save($model)
    {
        $model->save();
        $model->load('parentGroup');
    }

    public function permissions(Request $request, Role $role)
    {
        return JsonResource::make($role->permissions);
    }

    public function setPermissions(Request $request, Role $role)
    {
        $role->permissions()->sync($request->permission_ids);
    }
}
