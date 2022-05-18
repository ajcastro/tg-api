<?php

namespace App\Http\Queries;

use App\Http\Queries\BaseQuery;
use App\Http\Queries\Contracts\QueryContract;
use App\Http\Queries\CustomSorts\SortBySub;
use App\Models\Game;
use App\Models\GameSetting;
use App\Models\User;
use App\Models\Website;
use Illuminate\Support\Arr;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\AllowedSort;

class GameSettingQuery extends BaseQuery implements QueryContract
{
    public function __construct()
    {
        parent::__construct(GameSetting::query());
    }

    public function withFields()
    {
        $this->allowedFields([
            ...GameSetting::allowableFields(),
        ]);

        return $this;
    }

    public function withInclude()
    {
        $this->allowedIncludes([
            'game',
        ]);

        return $this;
    }

    public function withFilter()
    {
        $this->allowedFilters([
            AllowedFilter::callback('website_code', function ($query, $website_code) {
                $website = Website::query()->where('code', $website_code)->firstOrFail(['id', 'code']);
                $query->where('website_id', $website->id);
            }),
            AllowedFilter::callback('game_codes', function ($query, $game_codes) {
                $games = Game::query()->whereIn('code', Arr::wrap($game_codes))->get(['id', 'code']);
                $query->whereIn('game_id', $games->pluck('id'));
            }),
        ]);

        return $this;
    }

    public function withSort()
    {
        $this->allowedSorts([
            ...GameSetting::allowableFields(),
        ]);

        return $this;
    }
}
