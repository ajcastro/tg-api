<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GameSetting extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'website_id',
        'game_id',
        'min_bet',
        'max_bet',
        'win_multiplier',
        'percentage_discount',
        'percentage_kei',
        'limit',
        'limit_total',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'website_id' => 'integer',
        'game_id' => 'integer',
        'win_multiplier' => 'decimal',
        'percentage_discount' => 'decimal',
        'percentage_kei' => 'decimal',
    ];

    public function website()
    {
        return $this->belongsTo(Website::class);
    }

    public function game()
    {
        return $this->belongsTo(Game::class);
    }
}
