<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\ContactSetting;
use App\Models\Website;

class ContactSettingFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ContactSetting::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'website_id' => Website::factory(),
            'title' => $this->faker->sentence(4),
            'value' => $this->faker->word,
            'is_active' => $this->faker->boolean,
            'is_shown' => $this->faker->boolean,
        ];
    }
}
