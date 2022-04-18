<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReferralSetting extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'referral_id',
        'game_category_id',
        'min_commission',
        'max_commission',
        'referral_level',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'referral_id' => 'integer',
        'game_category_id' => 'integer',
        'min_commission' => 'decimal:2',
        'max_commission' => 'decimal:2',
        'referral_level' => 'decimal:2',
    ];

    public function referral()
    {
        return $this->belongsTo(Referral::class);
    }

    public function gameCategory()
    {
        return $this->belongsTo(GameCategory::class);
    }
}
