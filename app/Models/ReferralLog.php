<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use App\Models\Contracts\RelatesToWebsite;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder as QueryBuilder;

class ReferralLog extends Model implements RelatesToWebsite
{
    use HasFactory, Traits\HasAllowableFields, Traits\AccessibilityFilter;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'website_id',
        'member_id',
        'referral_amount',
        'paid_period_from',
        'paid_period_thru',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'website_id' => 'integer',
        'member_id' => 'integer',
        'referral_amount' => 'decimal:2',
        'paid_period_from' => 'datetime',
        'paid_period_thru' => 'datetime',
    ];

    public static function booted()
    {
        static::saving(function (ReferralLog $referralLog) {
            $referralLog->referral_amount = static::calculateReferralAmount(
                $referralLog->turn_over_amount,
                $referralLog->referral_percentage
            );
        });
    }

    public static function calculateReferralAmount($turn_over_amount, $referral_percentage)
    {
        $result = bcmul($turn_over_amount, $referral_percentage, 2);
        return bcdiv($result, 100, 2);
    }

    public function website()
    {
        return $this->belongsTo(Website::class);
    }

    public function gameCategory()
    {
        return $this->belongsTo(GameCategory::class);
    }

    public function member()
    {
        return $this->belongsTo(Member::class);
    }

    public function uplinkMember()
    {
        return $this->belongsTo(Member::class);
    }

    public function scopeSearch($query, $search)
    {
        $query->whereHas('member', function ($query) use ($search) {
            $query->where('username', 'like', "%{$search}%");
        });
    }

    public function scopeOfWebsite(Builder|QueryBuilder $query, Website $website)
    {
        $query->where('website_id', $website->id);
    }
}
