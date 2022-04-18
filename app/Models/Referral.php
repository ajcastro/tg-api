<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Referral extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'website_id',
        'content',
        'is_active',
        'is_shown',
        'pay_period',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'website_id' => 'integer',
        'is_active' => 'boolean',
        'is_shown' => 'boolean',
        'pay_period' => 'integer',
    ];

    public function website()
    {
        return $this->belongsTo(Website::class);
    }

    public function settings()
    {
        return $this->hasMany(ReferralSetting::class);
    }
}
