<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder as QueryBuilder;
use Illuminate\Support\Facades\Storage;

class Promotion extends Model implements Contracts\RelatesToWebsite
{
    use HasFactory, Traits\HasAllowableFields, Traits\AccessibilityFilter, Traits\SetActiveStatus;

    const CALCULATION_TYPE_FIX_AMOUNT = 0;
    const CALCULATION_TYPE_PERCENTAGE = 1;

    const GIVEN_ON_DEPOSIT = 0;
    const GIVEN_AFTER_TURNOVER_REACHED = 1;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'website_id',
        'title',
        'short_description',
        'description',
        'sort_order',
        'slug',
        'image',
        'image_thumb',
        'is_active',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'website_id' => 'integer',
        'sort_order' => 'integer',
        'is_active' => 'boolean',
    ];

    public static function getPromotionsOfCurrentWebsite(Member $member)
    {
        return static::query()
            ->with('setting')
            ->ofCurrentWebsite()
            ->availableFor($member)
            ->notExpired()
            ->orderBy('sort_order')
            ->get();
    }

    public function website()
    {
        return $this->belongsTo(Website::class);
    }

    public function setting()
    {
        return $this->hasOne(PromotionSetting::class)->withDefault();
    }

    public function promotionSetting()
    {
        return $this->setting();
    }

    public function bankGroups()
    {
        return $this->belongsToMany(BankGroup::class, 'promotions_bank_groups');
    }

    public function games()
    {
        return $this->belongsToMany(Menu::class, 'promotions_games', 'promotion_id', 'game_id');
    }

    public function scopeOfCurrentWebsite($query)
    {
        $query->where('website_id', Website::getWebsiteId());
    }

    public function scopeAvailableFor($query, Member $member)
    {
        $query->where('is_active', 1);
        $query->whereHas('setting', function ($query) use ($member) {

            $query->where(function ($query) use ($member) {
                $query->where('is_for_new_member_only', 0);
                if ($member->isNewMember()) {
                    $query->orWhere('is_for_new_member_only', 1);
                }
            });
        });
    }

    public function scopeNotExpired($query)
    {
        $query->whereHas('setting', function ($query) {
            $now = now()->format('Y-m-d H:i:s');
            $query->whereRaw("('{$now}' between promotion_settings.valid_from and promotion_settings.valid_thru)");
        });
    }

    public function scopeSearch($query, $search)
    {
        $query->where(function ($query) use ($search) {
            $query->where('title', 'like', "%{$search}%");
            $query->orWhere('short_description', 'like', "%{$search}%");
        });
    }

    public function scopeOfWebsite(Builder|QueryBuilder $query, Website $website)
    {
        $query->where('website_id', $website->id);
    }

    public function getImageUrlAttribute()
    {
        /** @var \Illuminate\Filesystem\FilesystemAdapter */
        $storage = Storage::disk('public');

        return $this->image
            ? $storage->url($this->image)
            : null;
    }

    public function getImageThumbUrlAttribute()
    {
        /** @var \Illuminate\Filesystem\FilesystemAdapter */
        $storage = Storage::disk('public');

        // TODO: replace with image_thumb
        return $this->image
            ? $storage->url($this->image)
            : null;
    }

    public function shouldIncludeBonusToCalculateObligation()
    {
        return $this->setting->is_include_bonus_to_calculate_obligation;
    }

    public function calculateBonusAmount($deposit)
    {
        if ($this->setting->calculation_type === static::CALCULATION_TYPE_FIX_AMOUNT) {
            return $this->setting->calculation_fix_amount;
        }

        if ($this->setting->calculation_type === static::CALCULATION_TYPE_PERCENTAGE) {
            return $deposit * $this->setting->calculation_rate;
        }

        return 0;
    }

    public function calculateObligationAmount($deposit)
    {
        $amount = $this->shouldIncludeBonusToCalculateObligation()
            ? $deposit + $this->calculateBonusAmount($deposit)
            : $deposit;

        return $amount * $this->setting->turn_over_obligation;
    }

    public function isGivenOnDeposit()
    {
        return $this->setting->given_method === static::GIVEN_ON_DEPOSIT;
    }

    public function isAutoRelease()
    {
        return $this->setting->is_auto_release;
    }

    public function isPromotionType($promotion_type)
    {
        return $this->setting->promotion_type === $promotion_type;
    }
}
