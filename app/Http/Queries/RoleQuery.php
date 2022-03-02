<?php

namespace App\Http\Queries;

use App\Http\Queries\BaseQuery;
use App\Http\Queries\Contracts\QueryContract;
use App\Http\Queries\CustomSorts\SortBySub;
use App\Models\Role;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\AllowedSort;

class RoleQuery extends BaseQuery implements QueryContract
{
    public function __construct()
    {
        parent::__construct(Role::query());
    }

    public function withFields()
    {
        $this->allowedFields([
            ...Role::allowableFields(),
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
            ...Role::allowableFields(),
        ]);

        return $this;
    }
}
