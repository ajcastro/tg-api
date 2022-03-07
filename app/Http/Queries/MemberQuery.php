<?php

namespace App\Http\Queries;

use App\Http\Queries\BaseQuery;
use App\Http\Queries\Contracts\QueryContract;
use App\Http\Queries\CustomSorts\SortBySub;
use App\Models\Member;
use App\Models\MemberBank;
use App\Models\User;
use App\Models\Website;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\AllowedSort;

class MemberQuery extends BaseQuery implements QueryContract
{
    public function __construct()
    {
        parent::__construct(Member::applyAccessibilityFilter());
    }

    public function withFields()
    {
        $this->allowedFields([
            ...Member::allowableFields(),
            ...fields('website', Website::allowableFields()),
            ...fields('upline_referral', Member::allowableFields()),
            ...fields('banks', MemberBank::allowableFields()),
            ...fields('suspended_by', User::allowableFields()),
            ...fields('blacklisted_by', User::allowableFields()),
        ]);

        return $this;
    }

    public function withInclude()
    {
        $this->allowedIncludes([
            'website', 'upline_referral', 'suspended_by', 'blacklisted_by', 'banks',
            'active_log.website', 'referrals',
        ]);

        return $this;
    }

    public function withFilter()
    {
        $this->allowedFilters([
            AllowedFilter::exact('warning_status'),
            AllowedFilter::exact('upline_referral_id'),
            AllowedFilter::scope('search'),
            AllowedFilter::callback('active_log', function ($query, $value) {
                if (boolean($value)) {
                    $query->whereHas('activeLog');
                }
            }),
            AllowedFilter::callback('join_date', function ($query, array $value) {
                [$start_date, $end_date] = $value;
                $start_date = carbon($start_date)->startOfDay();
                $end_date = carbon($end_date)->endOfDay();
                $query->whereBetween('members.created_at', [$start_date, $end_date]);
            }),
        ]);

        return $this;
    }

    public function withSort()
    {
        $this->allowedSorts([
            ...Member::allowableFields(),
            'referrals_count',
            AllowedSort::custom('website', SortBySub::make(
                '__website',
                Website::query()
                ->select('code')
                ->whereColumn('members.website_id', 'websites.id')
            )),
            AllowedSort::custom('upline_referral_number', SortBySub::make(
                '__upline_referral_number',
                Member::query()
                ->from('members as upline_members')
                ->select('referral_number')
                ->whereColumn('members.upline_referral_id', 'upline_members.id')
            )),
            AllowedSort::custom('created_by', SortBySub::make(
                '__created_by',
                User::query()
                ->select('name')
                ->whereColumn('clients.created_by_id', 'users.id')
            )),
            AllowedSort::custom('updated_by', SortBySub::make(
                '__updated_by',
                User::query()
                ->select('name')
                ->whereColumn('clients.updated_by_id', 'users.id')
            )),
        ]);

        return $this;
    }
}
