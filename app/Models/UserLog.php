<?php

namespace App\Models;

use App\Models\Contracts\RelatesToWebsite;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder as QueryBuilder;
use Illuminate\Http\Request;

class UserLog extends Model implements RelatesToWebsite
{
    use HasFactory, Traits\HasAllowableFields, Traits\AccessibilityFilter;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'website_id',
        'user_id',
        'date',
        'user_ip',
        'user_info',
        'member_id',
        'category',
        'activity',
        'detail',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'website_id' => 'integer',
        'user_id' => 'integer',
        'date' => 'datetime',
        'member_id' => 'integer',
    ];


    public static function fromRequest(Request $request)
    {
        return UserLog::make([
            'website_id' => static::resolveWebsiteIdForUserLog($request),
            'user_id' => $request->user()->id,
            'date' => now(),
            'user_ip' => $request->ip(),
            'user_info' => agent_user_info(),
            'member_id' => static::resolveMemberIdForUserLog($request),
        ]);
    }

    public static function canResolveWebsiteId(Request $request): bool
    {
        return filled(static::resolveWebsiteIdForUserLog($request));
    }

    public static function resolveWebsiteIdForUserLog(Request $request)
    {
        return $request->input('website_selector_website_id');
    }

    public static function resolveMemberIdForUserLog(Request $request)
    {
        return $request->input('member_id');
    }

    public function website()
    {
        return $this->belongsTo(Website::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function member()
    {
        return $this->belongsTo(Member::class);
    }

    public function scopeOfWebsite(Builder|QueryBuilder $query, Website $website)
    {
        $query->where('website_id', $website->id);
    }

    public function scopeSearch($query, $search)
    {
        $query->where(function ($query) use ($search) {
            $query->whereHas('user', function ($query) use ($search) {
                $query->where('users.username', 'like', "%{$search}%");
            })
            ->orWhereHas('member', function ($query) use ($search) {
                $query->where('members.username', 'like', "%{$search}%");
            })
            ->orWhere('category', 'like', "%{$search}%");
        });
    }
}
