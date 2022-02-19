<?php

namespace App\Http\Queries;

use App\Http\Queries\BaseQuery;
use App\Http\Queries\Contracts\QueryContract;
use App\Http\Queries\CustomSorts\SortBySub;
use App\Models\Client;
use App\Models\User;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\AllowedSort;

class ClientQuery extends BaseQuery implements QueryContract
{
    public function __construct()
    {
        parent::__construct(Client::query());
    }

    public function withFields()
    {
        $this->allowedFields([
            ...Client::allowableFields(),
            ...fields('created_by', User::allowableFields()),
            ...fields('updated_by', User::allowableFields()),
        ]);

        return $this;
    }

    public function withInclude()
    {
        $this->allowedIncludes([
            'created_by', 'updated_by',
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
            ...Client::allowableFields(),
            AllowedSort::custom('created_by', SortBySub::make(
                '__created_by',
                User::query()
                ->select('name')
                ->whereColumn('clients.created_by_id', 'users.id')
            )),
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
