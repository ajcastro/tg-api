<?php

namespace App\Models;

use App\Http\Queries\WebsiteQuery;
use App\Models\Contracts\AccessibleByUser;
use App\Observers\SetsCreatedByAndUpdatedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Website extends Model implements AccessibleByUser
{
    use HasFactory, Traits\HasAllowableFields, Traits\SetActiveStatus, Traits\AccessibilityFilter;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'code',
        'assigned_client_id',
        'ip_address',
        'domain_name',
        'remarks',
        'is_active',
        'created_by_id',
        'updated_by_id',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'assigned_client_id' => 'integer',
        'is_active' => 'boolean',
        'created_by_id' => 'integer',
        'updated_by_id' => 'integer',
    ];

    protected $attributes = [
        'is_active' => 1,
    ];

    public static function booted()
    {
        static::observe(SetsCreatedByAndUpdatedBy::class);

        static::created(function (Website $website) {
            $pg = $website->client->getDefaultParentGroup();
            $pg && $pg->websites()->attach($website);
        });
    }

    public static function getWebsiteId(): int
    {
        return config('website.id') ?? value(function () {
           throw new \Exception("Config website.id or env WEBSITE_ID is not defined.");
        });
    }

    public function resolveRouteBinding($value, $field = null)
    {
        return (new WebsiteQuery)
            ->withFields()
            ->withInclude()
            ->withFilter()
            ->findOrFail($value);
    }

    public function parentGroups()
    {
        return $this->belongsToMany(ParentGroup::class, 'parent_groups_websites');
    }

    public function assignedClient()
    {
        return $this->belongsTo(Client::class);
    }

    public function client()
    {
        return $this->assignedClient();
    }

    public function members()
    {
        return $this->hasMany(Member::class);
    }

    public function createdBy()
    {
        return $this->belongsTo(User::class);
    }

    public function updatedBy()
    {
        return $this->belongsTo(User::class);
    }

    public function credit()
    {
        return $this->hasOne(WebsiteCredit::class)->withDefault();
    }

    public function scopeSearch($query, $search)
    {
        $query->where('code', 'like', "%{$search}%");
    }

    public function scopeAccessibleBy($query, User $user)
    {
        if ($user->isSuperAdmin()) {
            return;
        }

        if ($user->isClientSuperAdmin()) {
            $query->where('assigned_client_id', $user->getCurrentClient()->id ?? null);
            return;
        }

        $query->whereHas('parentGroups', function ($query) use ($user) {
            $query->where('parent_groups.id', $user->getCurrentParentGroup()->id ?? null);
        });
    }

    public function updateCredit($amount)
    {
        $credit = $this->credit;
        $credit->credit = $amount;
        $credit->save();

        return $credit;
    }

    public function incrementCredit($amount)
    {
        $credit = $this->credit;
        $credit->credit = bcadd($credit->credit, $amount, 2);
        $credit->save();
    }

    public function decrementCredit($amount)
    {
        $credit = $this->credit;
        $credit->credit = bcsub($credit->credit, $amount, 2);
        $credit->save();
    }
}
