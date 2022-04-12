<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Bank extends Model
{
    use HasFactory, Traits\HasAllowableFields, Traits\SetActiveStatus;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'bank_group_id',
        'code',
        'name',
        'website',
        'logo',
        'is_active',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'bank_group_id' => 'integer',
        'is_active' => 'boolean',
    ];


    public static function getBanksOfCurrentWebsite()
    {
        return memo(__METHOD__, function () {
            return static::query()
                ->orderBy('code')
                ->get();
        });
    }

    public function bankGroup()
    {
        return $this->belongsTo(BankGroup::class);
    }

    public function scopeSearch($query, $search)
    {
        $query->where(function ($query) use ($search) {
            $query->where('code', 'like', "%{$search}%");
            $query->orWhere('name', 'like', "%{$search}%");
        });
    }

    public function getLogoUrlAttribute()
    {
        /** @var \Illuminate\Filesystem\FilesystemAdapter */
        $storage = Storage::disk('public');

        return $this->logo
            ? $storage->url($this->logo)
            : null;
    }
}
