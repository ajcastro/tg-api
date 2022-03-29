<?php

namespace App\Http\Queries;

use App\Http\Queries\BaseQuery;
use App\Http\Queries\Contracts\QueryContract;
use App\Http\Queries\CustomSorts\SortBySub;
use App\Models\CompanyBank;
use App\Models\User;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\AllowedSort;

class CompanyBankQuery extends BaseQuery implements QueryContract
{
    public function __construct()
    {
        parent::__construct(CompanyBank::query());
    }

    public function withFields()
    {
        $this->allowedFields([
            ...CompanyBank::allowableFields(),
        ]);

        return $this;
    }

    public function withInclude()
    {
        // $this->allowedIncludes([
        // ]);

        return $this;
    }

    public function withFilter()
    {
        $this->allowedFilters([
            AllowedFilter::exact('is_active'),
        ]);

        return $this;
    }

    public function withSort()
    {
        $this->allowedSorts([
            ...CompanyBank::allowableFields(),
        ]);

        return $this;
    }
}
