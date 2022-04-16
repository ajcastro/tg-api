<?php

namespace App\Http\Queries;

use App\Http\Queries\BaseQuery;
use App\Http\Queries\Contracts\QueryContract;
use App\Http\Queries\CustomSorts\SortBySub;
use App\Models\GameCategory;
use App\Models\Member;
use App\Models\RebateLog;
use App\Models\User;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\AllowedSort;

class RebateLogQuery extends BaseQuery implements QueryContract
{
    public function __construct()
    {
        parent::__construct(RebateLog::applyAccessibilityFilter());
    }

    public function withFields()
    {
        $this->allowedFields([
            ...RebateLog::allowableFields(),
            ...fields('member', Member::allowableFields()),
            ...fields('game_category', GameCategory::allowableFields()),
        ]);

        return $this;
    }

    public function withInclude()
    {
        $this->allowedIncludes([
            'member', 'game_category',
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
                $query->whereBetween('rebate_logs.created_at', [$start_date, $end_date]);
            }),
        ]);

        return $this;
    }

    public function withSort()
    {
        $this->allowedSorts([
            ...RebateLog::allowableFields(),
            AllowedSort::custom('member', SortBySub::make(
                '__member',
                Member::query()
                ->select('username')
                ->whereColumn('rebate_logs.member_id', 'members.id')
            )),
            AllowedSort::custom('game_category', SortBySub::make(
                '__game_category',
                GameCategory::query()
                ->select('title')
                ->whereColumn('rebate_logs.game_category_id', 'game_categories.id')
            )),
        ]);

        return $this;
    }
}
