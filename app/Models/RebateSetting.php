<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RebateSetting extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'rebate_id',
        'game_category_id',
        'percentage_level_0',
        'percentage_level_1',
        'percentage_level_2',
        'pay_out_by',
        'min_amount',
        'max_amount',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'category_id' => 'integer',
        'new_member' => 'decimal:2',
        'regular_member' => 'decimal:2',
        'pay_out_by' => 'integer',
        'min_amount' => 'decimal:2',
        'max_amount' => 'decimal:2',
    ];

    public function gameCategory()
    {
        return $this->belongsTo(GameCategory::class);
    }
}
