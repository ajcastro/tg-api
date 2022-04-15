<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Menu;
use App\Models\RebateSetting;

class RebateSettingFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = RebateSetting::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'category_id' => Menu::factory(),
            'new_member' => $this->faker->randomFloat(2, 0, 9999999999999.99),
            'regular_member' => $this->faker->randomFloat(2, 0, 9999999999999.99),
            'pay_out_by' => $this->faker->randomDigitNotNull,
            'min_amount' => $this->faker->randomFloat(2, 0, 9999999999999.99),
            'max_amount' => $this->faker->randomFloat(2, 0, 9999999999999.99),
        ];
    }
}
