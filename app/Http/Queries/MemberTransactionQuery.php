<?php

namespace App\Http\Queries;

use App\Enums\MemberTransactionStatus;
use App\Http\Queries\BaseQuery;
use App\Http\Queries\Contracts\QueryContract;
use App\Http\Queries\CustomSorts\SortBySub;
use App\Models\Member;
use App\Models\MemberTransaction;
use App\Models\User;
use App\Models\Website;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\AllowedSort;

class MemberTransactionQuery extends BaseQuery implements QueryContract
{
    public function __construct()
    {
        parent::__construct(MemberTransaction::applyAccessibilityFilter());
    }

    public function withFields()
    {
        $this->allowedFields([
            ...MemberTransaction::allowableFields(),
            ...fields('website', Website::allowableFields()),
            ...fields('member', Member::allowableFields()),
            ...fields('approved_by', User::allowableFields()),
        ]);

        return $this;
    }

    public function withInclude()
    {
        $this->allowedIncludes([
            'website', 'member', 'approved_by',
        ]);

        return $this;
    }

    public function withFilter()
    {
        $this->allowedFilters([
            AllowedFilter::exact('website_id'),
            AllowedFilter::exact('type'),
            AllowedFilter::exact('status'),
            AllowedFilter::exact('is_adjustment'),
            AllowedFilter::scope('search'),
            AllowedFilter::callback('created_at_range', function ($query, array $value) {
                [$start_date, $end_date] = $value;
                $start_date = carbon($start_date)->startOfDay();
                $end_date = carbon($end_date)->endOfDay();
                $query->whereBetween('member_transactions.created_at', [$start_date, $end_date]);
            }),
            AllowedFilter::callback('new', function ($query, $value) {
                if (boolean($value)) {
                    $query->where('member_transactions.status', MemberTransactionStatus::NEW);
                } else {
                    $query->where('member_transactions.status', '!=', MemberTransactionStatus::NEW);
                }
            }),
        ]);

        return $this;
    }

    public function withSort()
    {
        $this->allowedSorts([
            ...MemberTransaction::allowableFields(),
            AllowedSort::custom('website', SortBySub::make(
                '__website',
                Website::query()
                ->select('code')
                ->whereColumn('member_transactions.website_id', 'websites.id')
            )),
            AllowedSort::custom('username', SortBySub::make(
                '__username',
                Member::query()
                ->select('username')
                ->whereColumn('member_transactions.member_id', 'members.id')
            )),
            AllowedSort::custom('approved_by', SortBySub::make(
                '__approved_by',
                User::query()
                ->select('name')
                ->whereColumn('member_transactions.approved_by_id', 'users.id')
            )),
        ]);

        return $this;
    }
}
