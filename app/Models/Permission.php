<?php

namespace App\Models;

use Exception;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Permission extends Model
{
    use HasFactory, Traits\HasAllowableFields;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'label',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'casl' => 'json',
    ];

    public static function booted()
    {
        static::creating(function (Permission $permission) {
            if (Str::startsWith($permission->label, 'Menu -') && blank($permission->admin_redirect)) {
                throw new Exception("Attribute admin_redirect is required for {$permission->label}.");
            }
        });
    }
}
