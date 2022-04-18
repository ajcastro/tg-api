<?php

namespace Database\Factories;

use App\Models\GameCategory;
use App\Models\Member;
use App\Models\ReferralLog;
use App\Models\ReferralLogDetail;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ReferralLogDetailFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ReferralLogDetail::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'referral_log_id' => ReferralLog::factory(),
            'downlink_member_id' => Member::factory(),
            'game_category_id' => GameCategory::factory(),
            'turn_over_amount' => $this->faker->randomFloat(2, 0, 99_999_999),
            'referral_percentage' => $this->faker->randomFloat(2, 0, 9.99),
            'paid_period_from' => $this->faker->dateTimeBetween('-1 month'),
            'paid_period_thru' => function ($data) {
                return carbon($data['paid_period_from'])->addMonthNoOverflow();
            },
        ];
    }
}
