<?php

namespace App\Http\Queries;

use App\Http\Queries\BaseQuery;
use App\Http\Queries\Contracts\QueryContract;
use App\Http\Queries\CustomSorts\SortBySub;
use App\Models\PageContent;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\AllowedSort;

class PageContentQuery extends BaseQuery implements QueryContract
{
    public function __construct()
    {
        parent::__construct(PageContent::applyAccessibilityFilter());
    }

    public function withFields()
    {
        $this->allowedFields([
            ...PageContent::allowableFields(),
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
            ...PageContent::allowableFields(),
        ]);

        return $this;
    }
}
