<?php

namespace App\Models;

use App\Http\Queries\UserQuery;
use App\Models\Contracts\RelatesToWebsite;
use App\Observers\SetsCreatedByAndUpdatedBy;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Query\Builder as QueryBuilder;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;
use Laravel\Sanctum\HasApiTokens;
use Laravel\Sanctum\NewAccessToken;

class User extends Authenticatable implements RelatesToWebsite
{
    use HasApiTokens, HasFactory, Notifiable;
    use Traits\HasAllowableFields, Traits\SetActiveStatus, Traits\RelatesToWebsiteTrait, Traits\AccessibilityFilter;

    const ADMIN_ID = 1;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'username',
        'name',
        'email',
        'password',
        'is_active',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'is_active' => 'boolean',
    ];


    public static function booted()
    {
        static::observe(SetsCreatedByAndUpdatedBy::class);

        // static::creating(function (User $user) {
        //     $user->username = $user->username ?? $user->email;
        //     $user->role_id = 1;
        // });
    }

    public function resolveRouteBinding($value, $field = null)
    {
        return (new UserQuery)
            ->withFields()
            ->withInclude()
            ->withFilter()
            ->findOrFail($value);
    }

    public function parentGroups()
    {
        return $this->belongsToMany(ParentGroup::class, 'parent_groups_users')->withTimestamps();
    }

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by_id');
    }

    public function updatedBy()
    {
        return $this->belongsTo(User::class, 'updated_by_id');
    }

    public function scopeSearch($query, $search)
    {
        $query->where(function ($query) use ($search) {
            $query->where('username', 'like', "%{$search}%");
            $query->orWhere('email', 'like', "%{$search}%");
        });
    }

    public function scopeOfWebsite(Builder|QueryBuilder $query, Website $website)
    {
        $query->whereIn('users.parent_group_id', $this->getParentGroupIdsFromWebsitesSubquery($website));
    }

    public function createToken(string $name, array $abilities = ['*'], $tokenAttributes = [])
    {
        $token = $this->tokens()->create([
            'name' => $name,
            'token' => hash('sha256', $plainTextToken = Str::random(40)),
            'abilities' => $abilities,
        ] + $tokenAttributes);

        return new NewAccessToken($token, $token->getKey().'|'.$plainTextToken);
    }

    public function isSuperAdmin()
    {
        return $this->id === static::ADMIN_ID;
    }

    public function getClient()
    {
        return $this->parentGroup->client;
    }

    public function getCurrentParentGroup()
    {
        return $this->currentAccessToken()->parentGroup;
    }

    public function getCurrentRole()
    {
        return $this->currentAccessToken()->role;
    }

    public function findUserAccess(ParentGroup $parentGroup): ?UserAccess
    {
        return UserAccess::where(['user_id' => $this->id, 'parent_group_id' => $parentGroup->id])->first();
    }
}
