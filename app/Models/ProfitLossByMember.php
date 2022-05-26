<?php

namespace App\Models;

use App\Models\Contracts\RelatesToWebsite;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Query\Builder as QueryBuilder;

class ProfitLossByMember extends Model implements RelatesToWebsite
{
    use HasFactory, Traits\HasAllowableFields, Traits\AccessibilityFilter;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'website_id',
        'member_id',
        'provider_id',
        'game_id',
        'datetime',
        'deposit_count',
        'deposit_amount',
        'withdraw_count',
        'withdraw_amount',
        'adjustment_count',
        'adjustment_amount',
        'bet_count',
        'bet_amount',
        'bonus_count',
        'bonus_amount',
        'vba',
        'win_loss',
        'share_upline',
        'share_downline',
        'referral',
        'commission',
        'progressive',
        'total_win_loss',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'website_id' => 'integer',
        'member_id' => 'integer',
        'provider_id' => 'integer',
        'game_id' => 'integer',
        'datetime' => 'datetime',
        'deposit_count' => 'integer',
        'deposit_amount' => 'decimal:2',
        'withdraw_count' => 'integer',
        'withdraw_amount' => 'decimal:2',
        'adjustment_count' => 'integer',
        'adjustment_amount' => 'decimal:2',
        'bet_count' => 'integer',
        'bet_amount' => 'decimal:2',
        'bonus_count' => 'integer',
        'bonus_amount' => 'decimal:2',
        'vba' => 'decimal:2',
        'win_loss' => 'decimal:2',
        'share_upline' => 'decimal:2',
        'share_downline' => 'decimal:2',
        'referral' => 'decimal:2',
        'commission' => 'decimal:2',
        'progressive' => 'decimal:2',
        'total_win_loss' => 'decimal:2',
    ];

    public function website()
    {
        return $this->belongsTo(Website::class);
    }

    public function member()
    {
        return $this->belongsTo(Member::class);
    }

    public function provider()
    {
        return $this->belongsTo(Provider::class);
    }

    public function game()
    {
        return $this->belongsTo(Game::class);
    }

    public function scopeOfWebsite(Builder|QueryBuilder $query, Website $website)
    {
        $query->where('website_id', $website->id);
    }

    public function scopeSearch($query, $search)
    {
        $query->whereHas('member', function ($query) use ($search) {
            $query->where('members.username', 'like', "%{$search}%");
        });
    }
}
