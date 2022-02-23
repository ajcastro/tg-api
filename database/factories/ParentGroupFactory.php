<?php

namespace Database\Factories;

use App\Models\Client;
use App\Models\ParentGroup;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ParentGroupFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ParentGroup::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'client_id' => Client::factory(),
            'code' => $this->faker->unique()->words(5, true),
            'remarks' => $this->faker->word,
            'created_by_id' => User::factory(),
            'updated_by_id' => User::factory(),
        ];
    }
}
