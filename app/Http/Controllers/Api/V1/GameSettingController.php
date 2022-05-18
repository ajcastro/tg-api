<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Controllers\ResourceController;
use App\Http\Queries\GameSettingQuery;
use App\Models\GameSetting;
use Illuminate\Http\Request;

class GameSettingController extends ResourceController
{
    public function __construct()
    {
        $this->hook(function () {
            $this->model = GameSetting::class;
        });

        $this->hook(function () {
            $this->query = new GameSettingQuery;
        })->only(['index', 'show']);
    }
}
