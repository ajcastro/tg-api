<?php

namespace App\Http\Queries;

use App\Http\Queries\BaseQuery;
use App\Http\Queries\Contracts\QueryContract;
use App\Http\Queries\CustomSorts\SortBySub;
use App\Models\Client;
use App\Models\User;
use App\Models\Website;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\AllowedSort;

class WebsiteQuery extends BaseQuery implements QueryContract
{
    public function __construct()
    {
        parent::__construct(Website::query());
    }

    public function withFields()
    {
        $this->allowedFields([
            ...Website::allowableFields(),
            ...fields('assigned_client', Client::allowableFields()),
            ...fields('created_by', User::allowableFields()),
            ...fields('updated_by', User::allowableFields()),
        ]);

        return $this;
    }

    public function withInclude()
    {
        $this->allowedIncludes([
            'assigned_client', 'created_by', 'updated_by',
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
            ...Website::allowableFields(),
            AllowedSort::custom('assigned_client', SortBySub::make(
                '__assigned_client',
                Client::query()
                ->select('code')
                ->whereColumn('websites.assigned_client_id', 'clients.id')
            )),
            AllowedSort::custom('created_by', SortBySub::make(
                '__created_by',
                User::query()
                ->select('name')
                ->whereColumn('websites.created_by_id', 'users.id')
            )),
            AllowedSort::custom('updated_by', SortBySub::make(
                '__updated_by',
                User::query()
                ->select('name')
                ->whereColumn('websites.updated_by_id', 'users.id')
            )),
        ]);

        return $this;
    }
}
