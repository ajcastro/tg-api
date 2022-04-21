<?php

namespace App\Http\Queries;

use App\Http\Queries\BaseQuery;
use App\Http\Queries\Contracts\QueryContract;
use App\Http\Queries\CustomSorts\SortBySub;
use App\Models\GuideList;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\AllowedSort;

class GuideListQuery extends BaseQuery implements QueryContract
{
    public function __construct($query = null)
    {
        parent::__construct($query ?? GuideList::query());
    }

    public function withFields()
    {
        $this->allowedFields([
            ...GuideList::allowableFields(),
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
            AllowedFilter::scope('search'),
        ]);

        return $this;
    }

    public function withSort()
    {
        $this->allowedSorts([
            ...GuideList::allowableFields(),
        ]);

        return $this;
    }
}
