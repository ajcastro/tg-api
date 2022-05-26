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
            'provider_id' => Provider::factory(),
            'game_id' => Game::factory(),
            'datetime' => $this->faker->dateTime(),
            'deposit_count' => $this->faker->randomNumber(),
            'deposit_amount' => $this->faker->randomFloat(2, 0, 9999999999999.99),
            'withdraw_count' => $this->faker->randomNumber(),
            'withdraw_amount' => $this->faker->randomFloat(2, 0, 9999999999999.99),
            'adjustment_count' => $this->faker->randomNumber(),
            'adjustment_amount' => $this->faker->randomFloat(2, 0, 9999999999999.99),
            'bet_count' => $this->faker->randomNumber(),
            'bet_amount' => $this->faker->randomFloat(2, 0, 9999999999999.99),
            'bonus_count' => $this->faker->randomNumber(),
            'bonus_amount' => $this->faker->randomFloat(2, 0, 9999999999999.99),
            'vba' => $this->faker->randomFloat(2, 0, 9999999999999.99),
            'win_loss' => $this->faker->randomFloat(2, 0, 9999999999999.99),
            'share_upline' => $this->faker->randomFloat(2, 0, 9999999999999.99),
            'share_downline' => $this->faker->randomFloat(2, 0, 9999999999999.99),
            'referral' => $this->faker->randomFloat(2, 0, 9999999999999.99),
            'commission' => $this->faker->randomFloat(2, 0, 9999999999999.99),
            'progressive' => $this->faker->randomFloat(2, 0, 9999999999999.99),
            'total_win_loss' => $this->faker->randomFloat(2, 0, 9999999999999.99),
        ];
    }
}
