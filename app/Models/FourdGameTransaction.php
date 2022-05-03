<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FourdGameTransaction extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'website_id',
        'fourd_game_id',
        'member_id',
        'type',
        'total_pay',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'website_id' => 'integer',
        'fourd_game_id' => 'integer',
        'member_id' => 'integer',
        'total_pay' => 'decimal:2',
    ];

    public function website()
    {
        return $this->belongsTo(Website::class);
    }

    public function fourdGame()
    {
        return $this->belongsTo(FourdGame::class);
    }

    public function member()
    {
        return $this->belongsTo(Member::class);
    }

    public function fourdEntries()
    {
        return $this->hasMany(FourdGameEntry4d3d2d::class);
    }
}
