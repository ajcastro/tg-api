<?php

namespace App\Models;

use App\Http\Queries\ParentGroupQuery;
use App\Observers\SetsCreatedByAndUpdatedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ParentGroup extends Model implements Contracts\AccessibleByUser
{
    use HasFactory, Traits\HasAllowableFields, Traits\SetActiveStatus;

    const DEFAULT_ID = 1;
    const DEFAULT_CODE = 'spvadmin';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'client_id',
        'code',
        'remarks',
        'created_by_id',
        'updated_by_id',
        'is_active',
        'is_hidden',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'created_by_id' => 'integer',
        'updated_by_id' => 'integer',
        'is_active' => 'boolean',
        'is_hidden' => 'boolean',
    ];

    protected $attributes = [
        'is_active' => 1,
        'is_hidden' => 0,
    ];


    public static function booted()
    {
        static::observe(SetsCreatedByAndUpdatedBy::class);

        static::creating(function (ParentGroup $parentGroup) {
            /** @var User */
            $user = auth()->user();
            $parentGroup->client_id = $parentGroup->client_id ?? $user->getClient()->id;
        });
    }

    public static function getDefault()
    {
        return static::where('code', static::DEFAULT_CODE)->firstOrFail();
    }

    public static function findByCode($code)
    {
        return static::where('code', $code)->first();
    }

    public function resolveRouteBinding($value, $field = null)
    {
        return (new ParentGroupQuery)
            ->withFields()
            ->withInclude()
            ->withFilter()
            ->findOrFail($value);
    }

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function websites()
    {
        return $this->belongsToMany(Website::class, 'parent_groups_websites')->withTimestamps();
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'parent_groups_users')->withTimestamps();
    }

    public function createdBy()
    {
        return $this->belongsTo(User::class);
    }

    public function updatedBy()
    {
        return $this->belongsTo(User::class);
    }

    public function scopeSearch($query, $search)
    {
        $query->where(function ($query) use ($search) {
            $query->where('code', 'like', "%{$search}%");
        });
    }

    public function scopeAccessibleBy($query, User $user)
    {
        $query->where('client_id', $user->getClient()->id);
    }
}
