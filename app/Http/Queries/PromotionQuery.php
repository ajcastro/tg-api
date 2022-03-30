<?php

namespace App\Http\Queries;

use App\Http\Queries\BaseQuery;
use App\Http\Queries\Contracts\QueryContract;
use App\Http\Queries\CustomSorts\SortBySub;
use App\Models\Promotion;
use App\Models\User;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\AllowedSort;

class PromotionQuery extends BaseQuery implements QueryContract
{
    public function __construct()
    {
        parent::__construct(Promotion::applyAccessibilityFilter());
    }

    public function withFields()
    {
        $this->allowedFields([
            ...Promotion::allowableFields(),
        ]);

        return $this;
    }

    public function withInclude()
    {
        $this->allowedIncludes([
            'setting',
        ]);

        return $this;
    }

    public function withFilter()
    {
        $this->allowedFilters([
            AllowedFilter::scope('search'),
            AllowedFilter::exact('is_active'),
        ]);

        return $this;
    }

    public function withSort()
    {
        $this->allowedSorts([
            ...Promotion::allowableFields(),
        ]);

        return $this;
    }
}
