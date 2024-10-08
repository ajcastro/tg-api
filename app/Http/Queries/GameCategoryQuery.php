<?php

namespace App\Http\Queries;

use App\Http\Queries\BaseQuery;
use App\Http\Queries\Contracts\QueryContract;
use App\Http\Queries\CustomSorts\SortBySub;
use App\Models\GameCategory;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\AllowedSort;

class GameCategoryQuery extends BaseQuery implements QueryContract
{
    public function __construct()
    {
        parent::__construct(GameCategory::query());
    }

    public function withFields()
    {
        $this->allowedFields([
            ...GameCategory::allowableFields(),
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
        // $this->allowedFilters([
        // ]);

        return $this;
    }

    public function withSort()
    {
        $this->allowedSorts([
            ...GameCategory::allowableFields(),
        ]);

        return $this;
    }
}
