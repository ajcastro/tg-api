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
            'from' => $this->faker->dateTimeBetween('-1 month'),
            'to' => function ($data) {
                return carbon($data['from'])->addHour();
            },
            'amount' => $this->faker->randomFloat(2, 0, 99_999),
            'description' => $this->makeDescription(),
        ];
    }

    private function makeDescription()
    {
        $collect = collect(['Main', 'PG Slot', 'Sports', 'Slot']);

        $first = $collect->random();
        $second = $collect->reject($first)->random();

        return "From {$first} to {$second}";
    }
}
