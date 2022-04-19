<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PageContent extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'website_id',
        'short_description',
        'is_shown',
        'meta_title',
        'meta_keyword',
        'meta_description',
        'content',
        'is_footer_displayed',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'website_id' => 'integer',
        'is_shown' => 'boolean',
        'is_footer_displayed' => 'boolean',
    ];

    public function website()
    {
        return $this->belongsTo(Website::class);
    }
}
