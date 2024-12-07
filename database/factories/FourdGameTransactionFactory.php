<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\FourdGame;
use App\Models\FourdGameTransaction;
use App\Models\Member;
use App\Models\Website;

class FourdGameTransactionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = FourdGameTransaction::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'website_id' => Website::factory(),
            'fourd_game_id' => FourdGame::factory(),
            'member_id' => Member::factory(),
            'type' => $this->faker->word,
            'total_pay' => $this->faker->randomFloat(2, 0, 9999999999999.99),
        ];
    }
}
