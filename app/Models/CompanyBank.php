<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Query\Builder as QueryBuilder;

class CompanyBank extends Model implements Contracts\RelatesToWebsite
{
    use HasFactory, Traits\SetActiveStatus, Traits\HasAllowableFields, Traits\AccessibilityFilter;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'website_id',
        'bank_type',
        'bank_code',
        'bank_acc_no',
        'bank_acc_name',
        'is_active',
        'is_auto_update_balance',
        'bank_factor',
        'min_amount',
        'max_amount',
    ];

    protected $attributes = [
        'is_active' => 1,
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'website_id' => 'integer',
        'is_active' => 'boolean',
        'is_auto_update_balance' => 'boolean',
        'bank_factor' => 'decimal:2',
        'min_amount' => 'integer',
        'max_amount' => 'integer',
    ];

    public static function getCompanyBanksOfCurrentWebsite($bank_type = null)
    {
        return memo([__METHOD__, $bank_type], function () use ($bank_type) {
            return static::ofCurrentWebsite()
                ->when($bank_type, function ($query, $bank_type)  {
                    $query->where('bank_type', $bank_type);
                })
                ->orderBy('bank_code')
                ->get();
        });
    }

    public function website()
    {
        return $this->belongsTo(Website::class);
    }

    public function scopeOfCurrentWebsite($query)
    {
        $query->where('website_id', Website::getWebsiteId());
    }

    public function scopeOfWebsite(Builder|QueryBuilder $query, Website $website)
    {
        $query->where('website_id', $website->id);
    }

    public function scopeSearch($query, $search)
    {
        $query->where(function ($query) use ($search) {
            $query->where('bank_code', 'like', "%{$search}%");
            $query->orWhere('bank_acc_no', 'like', "%{$search}%");
            $query->orWhere('bank_acc_name', 'like', "%{$search}%");
        });
    }

    public function setBankTypeAttribute($value)
    {
        $this->attributes['bank_type'] = $value;

        if ($value === 'deposit') {
            $this->attributes['max_amount'] = 999_999_999;
        }

        if ($value === 'withdraw') {
            $this->attributes['min_amount'] = 0;
        }
    }
}
