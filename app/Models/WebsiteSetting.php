<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WebsiteSetting extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'website_id',
        'title',
        'logo',
        'favicon',
        'jackpot_image',
        'livechat_url',
        'livechat_code',
        'on_maintenance_mode',
        'timezone',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'website_id' => 'integer',
        'on_maintenance_mode' => 'boolean',
        'timezone' => 'integer',
    ];

    public function website()
    {
        return $this->belongsTo(Website::class);
    }
}
