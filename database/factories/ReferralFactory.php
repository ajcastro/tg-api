<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Referral;
use App\Models\Website;

class ReferralFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Referral::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'website_id' => Website::factory(),
            'content' => $this->faker->paragraphs(3, true),
            'is_active' => $this->faker->boolean,
            'is_shown' => $this->faker->boolean,
            'pay_period' => $this->faker->randomDigitNotNull,
        ];
    }
}
