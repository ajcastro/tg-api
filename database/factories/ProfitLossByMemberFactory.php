<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Game;
use App\Models\Member;
use App\Models\ProfitLossByMember;
use App\Models\Provider;
use App\Models\Website;

class ProfitLossByMemberFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ProfitLossByMember::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'website_id' => Website::factory(),
            'member_id' => Member::factory(),
            'provider_id' => 0,
            'game_id' => 0,
            'datetime' => $this->faker->dateTimeBetween('-1 month'),
            'deposit_count' => $this->faker->numberBetween(2, 5),
            'deposit_amount' => $this->faker->randomElement([200, 500, 1000, 2000, 3000, 5000, 8000, 10000]),
            'withdraw_count' => $this->faker->numberBetween(2, 5),
            'withdraw_amount' => $this->faker->randomElement([200, 500, 1000, 2000, 3000, 5000, 8000, 10000]),
            'adjustment_count' => $this->faker->numberBetween(2, 5),
            'adjustment_amount' => $this->faker->randomElement([200, 500, 1000, 2000, 3000, 5000, 8000, 10000]),
            'bet_count' => $this->faker->numberBetween(2, 5),
            'bet_amount' => $this->faker->randomElement([200, 500, 1000, 2000, 3000, 5000, 8000, 10000]),
            'bonus_count' => $this->faker->numberBetween(2, 5),
            'bonus_amount' => $this->faker->randomElement([200, 500, 1000, 2000, 3000, 5000, 8000, 10000]),
            'vba' => $this->faker->randomElement([200, 500, 1000, 2000, 3000, 5000, 8000, 10000]),
            'win_loss' => $this->faker->randomElement([200, 500, 1000, 2000, 3000, 5000, 8000, 10000]),
            'share_upline' => $this->faker->randomElement([200, 500, 1000, 2000, 3000, 5000, 8000, 10000]),
            'share_downline' => $this->faker->randomElement([200, 500, 1000, 2000, 3000, 5000, 8000, 10000]),
            'referral' => $this->faker->randomElement([200, 500, 1000, 2000, 3000, 5000, 8000, 10000]),
            'commission' => $this->faker->randomElement([200, 500, 1000, 2000, 3000, 5000, 8000, 10000]),
            'progressive' => $this->faker->randomElement([200, 500, 1000, 2000, 3000, 5000, 8000, 10000]),
            'total_win_loss' => $this->faker->randomElement([200, 500, 1000, 2000, 3000, 5000, 8000, 10000]),
        ];
    }
}
