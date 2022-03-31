<?php

namespace App\Http\Controllers\Api\Admin;

use App\Enums\MemberTransactionStatus;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ResourceController;
use App\Http\Controllers\Traits\PaginateOrListResource;
use App\Http\Controllers\Traits\SetActiveStatus;
use App\Http\Queries\PromotionReleasesQuery;
use App\Http\Requests\Api\Admin\PromotionRequest;
use App\Http\Resources\PromotionRelease;
use App\Http\Resources\PromotionReleaseResource;
use App\Models\MemberTransaction;
use App\Models\Promotion;
use Illuminate\Http\UploadedFile;

class PromotionReleasesController extends Controller
{
    use PaginateOrListResource;

    public function __construct()
    {
        $this->hook(function () {
            $this->query = new PromotionReleasesQuery;
            $this->resource = PromotionReleaseResource::class;
        })->only(['index']);
    }
}
