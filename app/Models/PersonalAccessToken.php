<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\PersonalAccessToken as SanctumPersonalAccessToken;

class PersonalAccessToken extends SanctumPersonalAccessToken
{
    use HasFactory;

    protected $fillable = [
        'name',
        'token',
        'abilities',
        'parent_group_id',
        'role_id',
    ];

    public function parentGroup()
    {
        return $this->belongsTo(ParentGroup::class);
    }

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function getParentGroup()
    {
        return $this->parentGroup;
    }

    public function getRole()
    {
        return $this->role;
    }
}
