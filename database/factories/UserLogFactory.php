<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Member;
use App\Models\User;
use App\Models\UserLog;
use App\Models\Website;

class UserLogFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = UserLog::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'website_id' => Website::factory(),
            'user_id' => User::factory(),
            'date' => $this->faker->dateTimeBetween('-1 month'),
            'user_ip' => $this->faker->ipv4,
            'user_info' => $this->faker->word,
            'member_id' => Member::factory(),
            'category' => $this->faker->randomElement(['ADD', 'EDIT', 'APPROVE', 'REJECT', 'GENERAL', 'PROMO']),
            'activity' => function ($data) {
                return 'DEPOSIT #'.$this->faker->randomNumber(3);
            },
            'detail' => $this->faker->words(3, true),
        ];
    }
}
