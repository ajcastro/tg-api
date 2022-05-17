<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * TODO: Sync markets table from game4d
 */
class Market extends Model
{
    use HasFactory, Traits\HasAllowableFields;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'code',
        'name',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
    ];


    /**
     * This is a hasOne relation in conjunction with a website.
     */
    public function marketWebsite()
    {
        return $this->hasOne(MarketWebsite::class);
    }

    /**
     * This is a hasOne relation in conjunction with a website.
     */
    public function limitSetting()
    {
        return $this->hasOne(MarketLimitSetting::class)->withDefault();
    }

    public function scopeSearch($query, $search)
    {
        $query->where(function ($query) use ($search) {
            $query->where('code', 'like', "%{$search}%");
            $query->orWhere('name', 'like', "%{$search}%");
        });
    }
}
