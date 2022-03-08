<?php

namespace App\Http\Queries;

use App\Http\Queries\BaseQuery;
use App\Http\Queries\Contracts\QueryContract;
use App\Http\Queries\CustomSorts\SortBySub;
use App\Models\Client;
use App\Models\ParentGroup;
use App\Models\User;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\AllowedSort;

class ParentGroupQuery extends BaseQuery implements QueryContract
{
    public function __construct()
    {
        parent::__construct(ParentGroup::query()->where('is_hidden', 0));
    }

    public function withFields()
    {
        $this->allowedFields([
            ...ParentGroup::allowableFields(),
            ...fields('client', Client::allowableFields()),
            ...fields('created_by', User::allowableFields()),
            ...fields('updated_by', User::allowableFields()),
        ]);

        return $this;
    }

    public function withInclude()
    {
        $this->allowedIncludes([
            'client', 'created_by', 'updated_by',
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
            ...ParentGroup::allowableFields(),
            AllowedSort::custom('client', SortBySub::make(
                '__client',
                Client::query()
                ->select('code')
                ->whereColumn('parent_groups.client_id', 'clients.id')
            )),
            AllowedSort::custom('created_by', SortBySub::make(
                '__created_by',
                User::query()
                ->select('name')
                ->whereColumn('parent_groups.created_by_id', 'users.id')
            )),
            AllowedSort::custom('updated_by', SortBySub::make(
                '__updated_by',
                User::query()
                ->select('name')
                ->whereColumn('parent_groups.updated_by_id', 'users.id')
            )),
        ]);

        return $this;
    }
}
