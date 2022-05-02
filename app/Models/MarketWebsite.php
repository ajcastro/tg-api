<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MarketWebsite extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'market_id',
        'website_id',
        'period',
        'result_day',
        'off_day',
        'close_time',
        'result_time',
        'updated_by_id',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'market_id' => 'integer',
        'website_id' => 'integer',
        'updated_by_id' => 'integer',
    ];

    public function market()
    {
        return $this->belongsTo(Market::class);
    }

    public function website()
    {
        return $this->belongsTo(Website::class);
    }

    public function updatedBy()
    {
        return $this->belongsTo(User::class);
    }
}
