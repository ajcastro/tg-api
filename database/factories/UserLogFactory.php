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
            'date' => $this->faker->dateTime(),
            'user_ip' => $this->faker->ipv4,
            'user_info' => $this->faker->word,
            'member_id' => Member::factory(),
            'category' => $this->faker->word,
            'activity' => $this->faker->word,
            'detail' => $this->faker->text,
        ];
    }
}
