<?php

namespace App\Http\Queries;

use App\Http\Queries\BaseQuery;
use App\Http\Queries\Contracts\QueryContract;
use App\Http\Queries\CustomSorts\SortBySub;
use App\Models\GameCategory;
use App\Models\Member;
use App\Models\ReferralLog;
use App\Models\User;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\AllowedSort;

class ReferralLogQuery extends BaseQuery implements QueryContract
{
    public function __construct()
    {
        parent::__construct(ReferralLog::applyAccessibilityFilter());
    }

    public function withFields()
    {
        $this->allowedFields([
            ...ReferralLog::allowableFields(),
            ...fields('game_category', GameCategory::allowableFields()),
            ...fields('member', Member::allowableFields()),
            ...fields('uplink_member', Member::allowableFields()),
        ]);

        return $this;
    }

    public function withInclude()
    {
        $this->allowedIncludes([
            'game_category',
            'member',
            'uplink_member',
        ]);

        return $this;
    }

    public function withFilter()
    {
        $this->allowedFilters([
            AllowedFilter::scope('search'),
            AllowedFilter::callback('date_range', function ($query, array $value) {
                [$start_date, $end_date] = $value;
                $start_date = carbon($start_date)->startOfDay();
                $end_date = carbon($end_date)->endOfDay();
                $query->whereBetween('referral_logs.created_at', [$start_date, $end_date]);
            }),
        ]);

        return $this;
    }

    public function withSort()
    {
        $this->allowedSorts([
            ...ReferralLog::allowableFields(),
            AllowedSort::custom('member', SortBySub::make(
                '__member',
                Member::query()
                ->select('username')
                ->whereColumn('referral_logs.member_id', 'members.id')
            )),
            AllowedSort::custom('uplink_member', SortBySub::make(
                '__uplink_member',
                Member::query()
                ->select('username')
                ->whereColumn('referral_logs.uplink_member_id', 'members.id')
            )),
            AllowedSort::custom('game_category', SortBySub::make(
                '__game_category',
                GameCategory::query()
                ->select('title')
                ->whereColumn('referral_logs.game_category_id', 'game_categories.id')
            )),
        ]);

        return $this;
    }
}
