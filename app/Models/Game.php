<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'game_category_id',
        'menu_id',
        'title',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'game_category_id' => 'integer',
    ];

    public function gameCategory()
    {
        return $this->belongsTo(GameCategory::class);
    }

    public function menu()
    {
        return $this->belongsTo(Menu::class);
    }
}
