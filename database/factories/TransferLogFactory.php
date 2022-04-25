<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Member;
use App\Models\TransferLog;
use App\Models\Website;

class TransferLogFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = TransferLog::class;

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
            'date' => $this->faker->date(),
            'from' => $this->faker->date(),
            'to' => $this->faker->date(),
            'amount' => $this->faker->randomFloat(2, 0, 9999999999999.99),
            'description' => $this->faker->text,
        ];
    }
}
