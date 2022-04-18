<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\GameCategory;
use App\Models\Referral;
use App\Models\ReferralSetting;

class ReferralSettingFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ReferralSetting::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'referral_id' => Referral::factory(),
            'game_category_id' => GameCategory::factory(),
            'min_commission' => $this->faker->randomFloat(2, 0, 9999999999999.99),
            'max_commission' => $this->faker->randomFloat(2, 0, 9999999999999.99),
            'referral_level' => $this->faker->randomFloat(2, 0, 999.99),
        ];
    }
}
