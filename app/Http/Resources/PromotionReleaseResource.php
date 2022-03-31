<?php

namespace App\Http\Resources;

use App\Models\MemberTransaction;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Arr;

/**
 * @property MemberTransaction $resource
 */
class PromotionReleaseResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->resource->id,
            'username' => $this->resource->member->username,
            'promo_title' => $this->resource->memberPromotion->promotion->title,
            'deposit_amount' => $this->resource->memberPromotion->deposit_amount,
            'bonus_amount' => $this->resource->memberPromotion->bonus_amount,
            'obligation_amount' => $this->resource->memberPromotion->obligation_amount,
            'turn_over_amount' => $this->resource->memberPromotion->turn_over_amount,
            'status' => $this->resource->status,
            'status_display' => $this->resource->status_display,
            'created_at' => $this->resource->created_at,
            'updated_at' => $this->resource->updated_at,
        ];
    }
}
