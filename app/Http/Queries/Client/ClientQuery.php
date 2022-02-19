<?php

namespace App\Http\Queries\Client;

use App\Http\Queries\BaseQuery;
use App\Http\Queries\QueryContract;
use App\Models\Client;
use App\Models\User;
use Spatie\QueryBuilder\AllowedFilter;

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
            'id', 'code', 'percentage_share',
        ])
        ->defaultSort('id');

        return $this;
    }
}
