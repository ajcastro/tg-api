<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\ResourceController;
use App\Http\Controllers\Traits\SetActiveStatus;
use App\Http\Queries\GameCategoryQuery;
use App\Http\Requests\Api\Admin\GameCategoryRequest;
use App\Models\GameCategory;

class GameCategoryController extends ResourceController
{
    use SetActiveStatus;

    public function __construct()
    {
        $this->hook(function () {
            $this->model = GameCategory::class;
        });

        $this->hook(function () {
            $this->query = new GameCategoryQuery;
        })->only(['index', 'show']);

        // $this->hook(function () {
        //     $this->request = GameCategoryRequest::class;
        // })->only(['store', 'update']);
    }
}
