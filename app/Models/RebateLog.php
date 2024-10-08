<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder as QueryBuilder;

class RebateLog extends Model implements Contracts\RelatesToWebsite
{
    use HasFactory, Traits\HasAllowableFields, Traits\AccessibilityFilter;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'website_id',
        'rebate_id',
        'game_category_id',
        'member_id',
        'turn_over_amount',
        'rebate_percentage',
        'rebate_amount',
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
        'rebate_id' => 'integer',
        'game_category_id' => 'integer',
        'member_id' => 'integer',
        'turn_over_amount' => 'decimal:2',
        'rebate_percentage' => 'decimal:2',
        'rebate_amount' => 'decimal:2',
        'paid_period_from' => 'datetime',
        'paid_period_thru' => 'datetime',
    ];


    public static function booted()
    {
        static::saving(function (RebateLog $rebateLog) {
            $rebateLog->rebate_amount = static::calculateRebateAmount(
                $rebateLog->turn_over_amount,
                $rebateLog->rebate_percentage
            );
        });
    }

    public static function calculateRebateAmount($turn_over_amount, $rebate_percentage)
    {
        $result = bcmul($turn_over_amount, $rebate_percentage, 2);
        return bcdiv($result, 100, 2);
    }

    public function website()
    {
        return $this->belongsTo(Website::class);
    }

    public function rebate()
    {
        return $this->belongsTo(Rebate::class);
    }

    public function gameCategory()
    {
        return $this->belongsTo(GameCategory::class);
    }

    public function member()
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
