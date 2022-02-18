<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Client;
use App\Models\User;

class ClientFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Client::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'code' => $this->faker->word,
            'remarks' => $this->faker->word,
            'percentage_share' => $this->faker->randomFloat(2, 0, 99999999.99),
            'created_by_id' => User::factory(),
            'updated_by_id' => User::factory(),
        ];
    }
}
