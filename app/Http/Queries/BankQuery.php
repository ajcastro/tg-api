<?php

namespace App\Http\Queries;

use App\Http\Queries\BaseQuery;
use App\Http\Queries\Contracts\QueryContract;
use App\Http\Queries\CustomSorts\SortBySub;
use App\Models\Bank;
use App\Models\BankGroup;
use App\Models\User;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\AllowedSort;

class BankQuery extends BaseQuery implements QueryContract
{
    public function __construct()
    {
        parent::__construct(Bank::query());
    }

    public function withFields()
    {
        $this->allowedFields([
            ...Bank::allowableFields(),
            ...fields('bank_group', BankGroup::allowableFields()),
        ]);

        return $this;
    }

    public function withInclude()
    {
        $this->allowedIncludes([
            'bank_group',
        ]);

        return $this;
    }

    public function withFilter()
    {
        $this->allowedFilters([
            AllowedFilter::scope('search'),
        ]);

        return $this;
    }

    public function withSort()
    {
        $this->allowedSorts([
            ...Bank::allowableFields(),
            AllowedSort::custom('group', SortBySub::make(
                '__bank_group',
                BankGroup::query()
                ->select('code')
                ->whereColumn('banks.bank_group_id', 'bank_groups.id')
            )),
        ]);

        return $this;
    }
}
