<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\PageContent;
use App\Models\Website;

class PageContentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = PageContent::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'website_id' => Website::factory(),
            'short_description' => $this->faker->word(),
            'url' => $this->faker->slug(),
            'is_shown' => 1,
            'meta_title' => $this->faker->word(),
            'meta_keyword' => $this->faker->word(),
            'meta_description' => $this->faker->word(),
            'content' => $this->faker->paragraphs(3, true),
            'is_footer_displayed' => 1,
        ];
    }
}
