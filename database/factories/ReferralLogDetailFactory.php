<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\DownlinkMember;
use App\Models\GameCategory;
use App\Models\ReferralLog;
use App\Models\ReferralLogDetail;

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
            'downlink_member_id' => DownlinkMember::factory(),
            'game_category_id' => GameCategory::factory(),
            'turn_over_amount' => $this->faker->randomFloat(2, 0, 9999999999999.99),
            'referral_percentage' => $this->faker->randomFloat(2, 0, 9.99),
            'referral_amount' => $this->faker->randomFloat(2, 0, 9999999999999.99),
            'paid_period_from' => $this->faker->dateTime(),
            'paid_period_thru' => $this->faker->dateTime(),
        ];
    }
}
