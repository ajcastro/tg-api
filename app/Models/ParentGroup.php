<?php

namespace App\Models;

use App\Http\Queries\ParentGroupQuery;
use App\Observers\SetsCreatedByAndUpdatedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ParentGroup extends Model
{
    use HasFactory, Traits\HasAllowableFields;

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
    ];


    public static function booted()
    {
        static::observe(SetsCreatedByAndUpdatedBy::class);
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

    public function createdBy()
    {
        return $this->belongsTo(User::class);
    }

    public function updatedBy()
    {
        return $this->belongsTo(User::class);
    }
}
