<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FourdGame extends Model
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
        'date',
        'period',
        'num1',
        'num2',
        'num3',
        'num4',
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
        'date' => 'date',
        'period' => 'integer',
        'num1' => 'integer',
        'num2' => 'integer',
        'num3' => 'integer',
        'num4' => 'integer',
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
