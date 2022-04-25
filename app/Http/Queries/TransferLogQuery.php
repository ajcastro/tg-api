<?php

namespace App\Http\Queries;

use App\Http\Queries\BaseQuery;
use App\Http\Queries\Contracts\QueryContract;
use App\Http\Queries\CustomSorts\SortBySub;
use App\Models\GameCategory;
use App\Models\Member;
use App\Models\TransferLog;
use App\Models\User;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\AllowedSort;

class TransferLogQuery extends BaseQuery implements QueryContract
{
    public function __construct()
    {
        parent::__construct(TransferLog::applyAccessibilityFilter());
    }

    public function withFields()
    {
        $this->allowedFields([
            ...TransferLog::allowableFields(),
            ...fields('member', Member::allowableFields()),
        ]);

        return $this;
    }

    public function withInclude()
    {
        $this->allowedIncludes([
            'member',
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
                $query->whereBetween('transfer_logs.from', [$start_date, $end_date]);
            }),
        ]);

        return $this;
    }

    public function withSort()
    {
        $this->allowedSorts([
            ...TransferLog::allowableFields(),
            AllowedSort::custom('member', SortBySub::make(
                '__member',
                Member::query()
                ->select('username')
                ->whereColumn('transfer_logs.member_id', 'members.id')
            )),
        ]);

        return $this;
    }
}
