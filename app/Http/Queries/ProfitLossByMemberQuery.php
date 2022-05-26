<?php

namespace App\Http\Queries;

use App\Http\Queries\BaseQuery;
use App\Http\Queries\Contracts\QueryContract;
use App\Http\Queries\CustomSorts\SortBySub;
use App\Models\Member;
use App\Models\ProfitLossByMember;
use App\Models\User;
use App\Models\Website;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\AllowedSort;

class ProfitLossByMemberQuery extends BaseQuery implements QueryContract
{
    public function __construct()
    {
        parent::__construct(ProfitLossByMember::applyAccessibilityFilter());
    }

    public function withFields()
    {
        $this->allowedFields([
            ...ProfitLossByMember::allowableFields(),
            ...fields('website', Website::allowableFields()),
            ...fields('member', Member::allowableFields()),
        ]);

        return $this;
    }

    public function withInclude()
    {
        $this->allowedIncludes([
            'website','member',
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
                $query->whereBetween('profit_loss_by_members.datetime', [$start_date, $end_date]);
            }),
        ]);

        return $this;
    }

    public function withSort()
    {
        $this->allowedSorts([
            ...ProfitLossByMember::allowableFields(),
            AllowedSort::custom('website', SortBySub::make(
                '__website',
                Website::query()
                ->select('code')
                ->whereColumn('profit_loss_by_members.website_id', 'websites.id')
            )),
            AllowedSort::custom('member', SortBySub::make(
                '__member',
                Member::query()
                ->select('username')
                ->whereColumn('profit_loss_by_members.member_id', 'members.id')
            )),
        ]);

        return $this;
    }
}
