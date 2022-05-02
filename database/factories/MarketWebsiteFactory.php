<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Market;
use App\Models\MarketWebsite;
use App\Models\User;
use App\Models\Website;

class MarketWebsiteFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = MarketWebsite::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'market_id' => Market::factory(),
            'website_id' => Website::factory(),
            'period' => $this->faker->word,
            'result_day' => $this->faker->word,
            'off_day' => $this->faker->word,
            'close_time' => $this->faker->word,
            'result_time' => $this->faker->word,
            'updated_by_id' => User::factory(),
        ];
    }
}
