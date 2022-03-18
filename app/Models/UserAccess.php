<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property User $user
 * @property ParentGroup $parentGroup
 * @property Role $role
 */
class UserAccess extends Model
{
    use HasFactory;

    protected $table = 'parent_groups_users';

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function parentGroup()
    {
        return $this->belongsTo(ParentGroup::class);
    }

    public function role()
    {
        return $this->belongsTo(Role::class);
    }
}
