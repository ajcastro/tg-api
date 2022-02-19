<?php

namespace App\Http\Queries;

use App\Http\Queries\BaseQuery;
use App\Http\Queries\Contracts\QueryContract;
use App\Models\User;
use App\Models\Website;
use Spatie\QueryBuilder\AllowedFilter;

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
            ...Website::allowableFields(),
        ]);

        return $this;
    }
}
