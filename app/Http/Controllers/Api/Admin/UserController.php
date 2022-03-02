<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\ResourceController;
use App\Http\Controllers\Traits\SetActiveStatus;
use App\Http\Queries\UserQuery;
use App\Http\Requests\Api\Admin\UserRequest;
use App\Models\User;

class UserController extends ResourceController
{
    use SetActiveStatus;

    public function __construct()
    {
        $this->hook(function () {
            $this->model = User::class;
        });

        $this->hook(function () {
            $this->query = new UserQuery;
        })->only(['index', 'show']);

        $this->hook(function () {
            $this->request = UserRequest::class;
        })->only(['store', 'update']);
    }
}
