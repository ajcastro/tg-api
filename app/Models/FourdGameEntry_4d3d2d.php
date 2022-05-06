<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FourdGameEntry4d3d2d extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'fourd_game_transaction_id',
        'num1',
        'num2',
        'num3',
        'num4',
        'game',
        'bet',
        'discount',
        'pay',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'fourd_game_transaction_id' => 'integer',
        'num1' => 'integer',
        'num2' => 'integer',
        'num3' => 'integer',
        'num4' => 'integer',
        'bet' => 'decimal:2',
        'discount' => 'decimal',
        'pay' => 'decimal:2',
    ];

    public function fourdGameTransaction()
    {
        return $this->belongsTo(FourdGameTransaction::class);
    }
}
