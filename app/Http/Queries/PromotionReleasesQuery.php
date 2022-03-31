<?php

namespace App\Http\Queries;

use App\Enums\MemberTransactionStatus;
use App\Http\Queries\BaseQuery;
use App\Http\Queries\Contracts\QueryContract;
use App\Http\Queries\CustomSorts\SortBySub;
use App\Models\MemberTransaction;
use App\Models\Promotion;
use App\Models\User;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\AllowedSort;

class PromotionReleasesQuery extends BaseQuery implements QueryContract
{
    public function __construct()
    {
        $query = MemberTransaction::applyAccessibilityFilter()
            ->where('member_transactions.status', MemberTransactionStatus::APPROVED)
            ->where('type', 'deposit') // TODO: change deposit and withdraw values into constant or enums
            ->whereHas('memberPromotion')
            ->with([
                'member:id,username',
                'memberPromotion:id,promotion_id,member_transaction_id,deposit_amount,bonus_amount,obligation_amount,turn_over_amount',
                'memberPromotion.promotion:id,title',
            ])
            ->select([
                'id',
                'member_id',
                'status',
                'created_at',
                'updated_at',
            ]);

        parent::__construct($query);
    }

    public function withFields()
    {
        // $this->allowedFields([
        //     ...Promotion::allowableFields(),
        // ]);

        return $this;
    }

    public function withInclude()
    {
        // $this->allowedIncludes([
        //     'setting',
        // ]);

        return $this;
    }

    public function withFilter()
    {
        $this->allowedFilters([
            AllowedFilter::callback('search', function ($query, $search) {
                $query->where(function ($query) use ($search)  {
                    $query->whereHas('member', function ($query) use ($search) {
                        $query->where('username', 'like', "%{$search}%");
                    });
                    $query->orWhereHas('memberPromotion.promotion', function ($query) use ($search) {
                        $query->where('promotions.title', 'like', "%{$search}%");
                    });
                });
            }),
            AllowedFilter::exact('status'),
            AllowedFilter::callback('given_method', function ($query, $given_method) {
                $query->whereHas('memberPromotion.promotion.setting', function ($query) use ($given_method) {
                    $query->where('given_method', $given_method);
                });
            }),
            // TODO: refactor duplicate code, duplicate in MemberQuery join_date filter
            AllowedFilter::callback('created_date', function ($query, array $value) {
                [$start_date, $end_date] = $value;
                $start_date = carbon($start_date)->startOfDay();
                $end_date = carbon($end_date)->endOfDay();
                $query->whereBetween('member_transactions.created_at', [$start_date, $end_date]);
            }),
        ]);

        return $this;
    }

    public function withSort()
    {
        $this->allowedSorts([
            ...MemberTransaction::allowableFields(),
        ]);

        return $this;
    }
}
