<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MarketLimitSetting extends Model
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
        'limit_line_4d',
        'limit_line_3d',
        'limit_line_2d',
        'limit_line_2d_front',
        'limit_line_2d_middle',
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
        'limit_line_4d' => 'integer',
        'limit_line_3d' => 'integer',
        'limit_line_2d' => 'integer',
        'limit_line_2d_front' => 'integer',
        'limit_line_2d_middle' => 'integer',
    ];

    public function market()
    {
        return $this->belongsTo(Market::class);
    }

    public function website()
    {
        return $this->belongsTo(Website::class);
    }
}
