<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\ResourceController;
use App\Http\Controllers\Traits\SetActiveStatus;
use App\Http\Queries\PromotionQuery;
use App\Http\Requests\Api\Admin\PromotionRequest;
use App\Http\UserLogAttributes\PromotionUserLog;
use App\Models\Promotion;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;

class PromotionController extends ResourceController
{
    use SetActiveStatus;

    public function __construct()
    {
        $this->hook(function () {
            $this->model = Promotion::class;
            $this->crudUserLog = new PromotionUserLog;
        });

        $this->hook(function () {
            $this->query = new PromotionQuery;
        })->only(['index', 'show']);

        $this->hook(function () {
            $this->request = PromotionRequest::class;
        })->only(['store', 'update']);

        $this->setUpCrudUserLog();
    }

    protected function resolveRecord(Request $request)
    {
        return $this->getRecord($request->route('promotion'));
    }

    protected function fill($promotion, $request)
    {
        parent::fill($promotion, $request);

        /** @var UploadedFile */
        $uploadedFile = $request->file('image');
        if ($uploadedFile) {
            $promotion->image = $uploadedFile->store("website/{$promotion->website_id}/images");
            // TODO: generate and assign filepath of image_thumb
        }
    }
}
