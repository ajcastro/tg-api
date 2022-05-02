<?php

namespace App\Http\Queries;

use App\Http\Queries\BaseQuery;
use App\Http\Queries\Contracts\QueryContract;
use App\Http\Queries\CustomSorts\SortBySub;
use App\Models\Market;
use App\Models\MarketWebsite;
use App\Models\User;
use App\Models\Website;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\AllowedSort;

class MarketWebsiteQuery extends BaseQuery implements QueryContract
{
    public function __construct()
    {
        parent::__construct(MarketWebsite::applyAccessibilityFilter());
    }

    public function withFields()
    {
        $this->allowedFields([
            ...MarketWebsite::allowableFields(),
            ...fields('market', Market::allowableFields()),
            ...fields('website', Website::allowableFields()),
            ...fields('updated_by', User::allowableFields()),
        ]);

        return $this;
    }

    public function withInclude()
    {
        $this->allowedIncludes([
            'market', 'website', 'updated_by',
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
            ...MarketWebsite::allowableFields(),
            AllowedSort::custom('market', SortBySub::make(
                '__market',
                Market::query()
                ->select('code')
                ->whereColumn('market_websites.market_id', 'markets.id')
            )),
            AllowedSort::custom('website', SortBySub::make(
                '__website',
                Website::query()
                ->select('domain_name')
                ->whereColumn('market_websites.website_id', 'websites.id')
            )),
            AllowedSort::custom('updated_by', SortBySub::make(
                '__updated_by',
                User::query()
                ->select('name')
                ->whereColumn('market_websites.updated_by_id', 'users.id')
            )),
        ]);

        return $this;
    }
}
