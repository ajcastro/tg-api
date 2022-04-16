<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\PaginateOrListResource;
use App\Http\Queries\PromotionReleasesQuery;
use App\Http\Resources\PromotionReleaseResource;
use App\Models\MemberPromotion;

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

    public function release(MemberPromotion $memberPromotion)
    {
        $memberPromotion->is_lock = false;
        $memberPromotion->save();
    }
}
