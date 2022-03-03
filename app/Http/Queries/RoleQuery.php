<?php

namespace App\Http\Queries;

use App\Http\Queries\BaseQuery;
use App\Http\Queries\Contracts\QueryContract;
use App\Http\Queries\CustomSorts\SortBySub;
use App\Models\Role;
use App\Models\User;
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
            ...fields('updated_by', User::allowableFields()),
        ]);

        return $this;
    }

    public function withInclude()
    {
        $this->allowedIncludes([
            'updated_by',
        ]);

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
