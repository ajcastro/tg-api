<?php

namespace App\Http\Queries;

use App\Http\Queries\BaseQuery;
use App\Http\Queries\Contracts\QueryContract;
use App\Http\Queries\CustomSorts\SortBySub;
use App\Models\ParentGroup;
use App\Models\Role;
use App\Models\User;
use App\Models\Website;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\AllowedSort;

class UserQuery extends BaseQuery implements QueryContract
{
    public function __construct()
    {
        parent::__construct(User::applyAccessibilityFilter());
    }

    public function withFields()
    {
        $this->allowedFields([
            ...User::allowableFields(),
            ...fields('parent_group', ParentGroup::allowableFields()),
            ...fields('role', Role::allowableFields()),
            ...fields('created_by', User::allowableFields()),
            ...fields('updated_by', User::allowableFields()),
        ]);

        return $this;
    }

    public function withInclude()
    {
        $this->allowedIncludes([
            'parent_group', 'role.permissions', 'created_by', 'updated_by',
        ]);

        return $this;
    }

    public function withFilter()
    {
        $this->allowedFilters([
            AllowedFilter::exact('parent_group_id'),
            AllowedFilter::exact('role_id'),
            AllowedFilter::exact('is_active'),
            AllowedFilter::scope('search'),
        ]);

        return $this;
    }

    public function withSort()
    {
        $this->allowedSorts([
            ...User::allowableFields(),
            AllowedSort::custom('parent_group_code', SortBySub::make(
                '__parent_group_code',
                Role::query()
                ->select('parent_groups.name')
                ->whereColumn('users.parent_group_id', 'parent_groups.id')
            )),
            AllowedSort::custom('role', SortBySub::make(
                '__role',
                Role::query()
                ->select('roles.name')
                ->whereColumn('users.role_id', 'roles.id')
            )),
            AllowedSort::custom('created_by', SortBySub::make(
                '__created_by',
                User::query()
                ->select('name')
                ->whereColumn('users.created_by_id', 'users.id')
            )),
            AllowedSort::custom('updated_by', SortBySub::make(
                '__updated_by',
                User::query()
                ->select('name')
                ->whereColumn('users.updated_by_id', 'users.id')
            )),
        ]);

        return $this;
    }
}
