<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\GameCategory;
use App\Models\Member;
use App\Models\Rebate;
use App\Models\RebateLog;
use App\Models\Website;

class RebateLogFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = RebateLog::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'website_id' => Website::factory(),
            'rebate_id' => Rebate::factory(),
            'game_category_id' => GameCategory::factory(),
            'member_id' => Member::factory(),
            'turn_over_amount' => $this->faker->randomFloat(2, 0, 99_999_999 ),
            'rebate_percentage' => $this->faker->randomFloat(2, 0, 9.99),
            'paid_period_from' => $this->faker->dateTime(),
            'paid_period_thru' => $this->faker->dateTime(),
        ];
    }
}
