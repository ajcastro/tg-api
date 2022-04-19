<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Website;
use App\Models\WebsiteSetting;

class WebsiteSettingFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = WebsiteSetting::class;

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
            'logo' => $this->faker->word,
            'favicon' => $this->faker->word,
            'jackpot_image' => $this->faker->word,
            'livechat_url' => $this->faker->word,
            'livechat_code' => $this->faker->word,
            'on_maintenance_mode' => $this->faker->boolean,
            'timezone' => $this->faker->numberBetween(-8, 8),
        ];
    }
}
