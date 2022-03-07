<?php

namespace App\Models;

use App\Http\Queries\ClientQuery;
use App\Observers\SetsCreatedByAndUpdatedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory, Traits\HasAllowableFields, Traits\SetActiveStatus;

    const DEFAULT_ID = 1;
    const DEFAULT_CODE = 'default';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'code',
        'remarks',
        'percentage_share',
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
        'percentage_share' => 'decimal:2',
        'created_by_id' => 'integer',
        'updated_by_id' => 'integer',
        'is_active' => 'boolean',
    ];

    protected $attributes = [
        'is_active' => 1,
    ];

    public static function booted()
    {
        static::observe(SetsCreatedByAndUpdatedBy::class);

        static::created(function (Client $client) {
            ParentGroup::create([
                'client_id' => $client->id,
                'code' => $client->code,
                'created_by_id' => $client->created_by_id,
                'updated_by_id' => $client->updated_by_id,
            ]);
        });
    }

    public function resolveRouteBinding($value, $field = null)
    {
        return (new ClientQuery)
            ->withFields()
            ->withInclude()
            ->withFilter()
            ->findOrFail($value);
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
        $query->where('code', 'like', "%{$search}%");
    }
}
