<?php

namespace App\Http\Queries;

use App\Http\Queries\BaseQuery;
use App\Http\Queries\Contracts\QueryContract;
use App\Http\Queries\CustomSorts\SortBySub;
use App\Models\GameCategory;
use App\Models\Member;
use App\Models\UserLog;
use App\Models\User;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\AllowedSort;

class UserLogQuery extends BaseQuery implements QueryContract
{
    public function __construct()
    {
        parent::__construct(UserLog::applyAccessibilityFilter());
    }

    public function withFields()
    {
        $this->allowedFields([
            ...UserLog::allowableFields(),
            ...fields('user', User::allowableFields()),
            ...fields('member', Member::allowableFields()),
        ]);

        return $this;
    }

    public function withInclude()
    {
        $this->allowedIncludes([
            'user', 'member',
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
                $query->whereBetween('user_logs.date', [$start_date, $end_date]);
            }),
        ]);

        return $this;
    }

    public function withSort()
    {
        $this->allowedSorts([
            ...UserLog::allowableFields(),
            AllowedSort::custom('user', SortBySub::make(
                '__user',
                User::query()
                ->select('username')
                ->whereColumn('user_logs.user_id', 'users.id')
            )),
            AllowedSort::custom('member', SortBySub::make(
                '__member',
                Member::query()
                ->select('username')
                ->whereColumn('user_logs.member_id', 'members.id')
            )),
        ]);

        return $this;
    }
}
