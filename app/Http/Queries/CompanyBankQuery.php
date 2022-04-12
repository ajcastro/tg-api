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
        $query = CompanyBank::applyAccessibilityFilter()
            ->when(!request()->filled('sort'), function ($query) {
                $query->orderBy('bank_code');
                $query->orderBy('bank_type');
            });

        parent::__construct($query);
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
            AllowedFilter::exact('bank_type'),
            AllowedFilter::scope('search'),
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
