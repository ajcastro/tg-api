<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\ResourceController;
use App\Http\Controllers\Traits\SetActiveStatus;
use App\Http\Queries\ContactSettingQuery;
use App\Http\Requests\Api\Admin\ContactSettingRequest;
use App\Models\ContactSetting;

class ContactSettingController extends ResourceController
{
    use SetActiveStatus;

    public function __construct()
    {
        $this->hook(function () {
            $this->model = ContactSetting::class;
        });

        $this->hook(function () {
            $this->query = new ContactSettingQuery;
        })->only(['index', 'show']);

        $this->hook(function () {
            $this->request = ContactSettingRequest::class;
        })->only(['store', 'update']);
    }
}
