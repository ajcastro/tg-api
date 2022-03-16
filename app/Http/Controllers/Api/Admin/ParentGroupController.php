<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\ResourceController;
use App\Http\Controllers\Traits\SetActiveStatus;
use App\Http\Queries\ParentGroupQuery;
use App\Http\Requests\Api\Admin\ParentGroupRequest;
use App\Models\ParentGroup;
use Illuminate\Http\Resources\Json\JsonResource;

class ParentGroupController extends ResourceController
{
    use SetActiveStatus;

    public function __construct()
    {
        $this->hook(function () {
            $this->model = ParentGroup::class;
        });

        $this->hook(function () {
            $this->query = new ParentGroupQuery;
        })->only(['index', 'show']);

        $this->hook(function () {
            $this->request = ParentGroupRequest::class;
        })->only(['store', 'update']);
    }

    public function users(ParentGroup $parentGroup)
    {
        $users = $parentGroup->userAccesses()->with('user', 'role')
        ->whereHas('user', function ($query) {
            $query->where('users.is_hidden', '!=', 1);
        })
        ->get()
        ->map(function ($access) {
            return $access->user->setRelation('role', $access->role);
        });

        return JsonResource::make($users);
    }
}
