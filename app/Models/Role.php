<?php

namespace App\Models;

use App\Http\Queries\RoleQuery;
use App\Observers\SetsCreatedByAndUpdatedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory, Traits\HasAllowableFields, Traits\SetActiveStatus;

    const ADMINISTRATOR_ID = 1;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'parent_group_id',
        'name',
    ];

    protected $attributes = [
        'is_active' => true,
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'is_active' => 'boolean',
    ];

    public static function booted()
    {
        static::observe(SetsCreatedByAndUpdatedBy::class);
    }

    public function resolveRouteBinding($value, $field = null)
    {
        return (new RoleQuery)
            ->withFields()
            ->withInclude()
            ->withFilter()
            ->findOrFail($value);
    }

    public function parentGroup()
    {
        return $this->belongsTo(ParentGroup::class);
    }

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by_id');
    }

    public function updatedBy()
    {
        return $this->belongsTo(User::class, 'updated_by_id');
    }

    public function permissions()
    {
        return $this->belongsToMany(Permission::class, 'roles_permissions')
            ->withTimestamps();
    }

    public function scopeSearch($query, $search)
    {
        $query->where(function ($query) use ($search) {
            $query->where('name', 'like', "%{$search}%");
        });
    }
}
