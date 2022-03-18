<?php

namespace App\Models;

use App\Http\Queries\RoleQuery;
use App\Models\Contracts\AccessibleByUser;
use App\Models\Contracts\RelatesToWebsite;
use App\Observers\SetsCreatedByAndUpdatedBy;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder as QueryBuilder;

/**
 * @property \Illuminate\Database\Eloquent\Collection $permissions
 */
class Role extends Model implements RelatesToWebsite, AccessibleByUser
{
    use HasFactory, Traits\HasAllowableFields, Traits\SetActiveStatus, Traits\RelatesToWebsiteTrait, Traits\AccessibilityFilter;

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

    protected $caslAbilities;

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

    public function scopeOfWebsite(Builder|QueryBuilder $query, Website $website)
    {
        $query->whereIn('roles.parent_group_id', $this->getParentGroupIdsFromWebsitesSubquery($website));
    }

    public function scopeAccessibleBy($query, User $user)
    {
        if ($user->isSuperAdmin()) {
            return;
        }

        if ($user->isClientSuperAdmin()) {
            $query->whereIn('parent_group_id', $user->getCurrentClient()->parentGroups()->pluck('id'));
            return;
        }

        $query->where('parent_group_id', $user->getCurrentParentGroup()->id ?? null);
    }

    public function assignAllPermissions()
    {
        $permissions = Permission::get();
        return $this->permissions()->sync($permissions);
    }

    public function getCaslAbilities(): array
    {
        return $this->caslAbilities ?? $this->caslAbilities = $this->permissions->pluck('casl')->all();
    }
}
