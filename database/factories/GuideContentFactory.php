<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\GuideContent;
use App\Models\GuideList;
use App\Models\Website;

class GuideContentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = GuideContent::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'website_id' => Website::factory(),
            'guide_list_id' => GuideList::factory(),
            'content' => $this->faker->paragraphs(3, true),
        ];
    }
}
