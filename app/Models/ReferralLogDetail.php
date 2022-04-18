<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReferralLogDetail extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'referral_log_id',
        'downlink_member_id',
        'game_category_id',
        'turn_over_amount',
        'referral_percentage',
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
        'referral_log_id' => 'integer',
        'downlink_member_id' => 'integer',
        'game_category_id' => 'integer',
        'turn_over_amount' => 'decimal:2',
        'referral_percentage' => 'decimal:2',
        'referral_amount' => 'decimal:2',
        'paid_period_from' => 'datetime',
        'paid_period_thru' => 'datetime',
    ];

    public static function booted()
    {
        static::saving(function (ReferralLogDetail $model) {
            $model->referral_amount = static::calculateReferralAmount(
                $model->turn_over_amount,
                $model->referral_percentage
            );
        });
    }

    public static function calculateReferralAmount($turn_over_amount, $referral_percentage)
    {
        $result = bcmul($turn_over_amount, $referral_percentage, 2);
        return bcdiv($result, 100, 2);
    }

    public function referralLog()
    {
        return $this->belongsTo(ReferralLog::class);
    }

    public function downlinkMember()
    {
        return $this->belongsTo(Member::class);
    }

    public function gameCategory()
    {
        return $this->belongsTo(GameCategory::class);
    }
}
