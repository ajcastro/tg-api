<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\GameCategory;
use App\Models\Member;
use App\Models\ReferralLog;
use App\Models\UplinkMember;
use App\Models\Website;

class ReferralLogFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ReferralLog::class;

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
            'paid_period_from' => $this->faker->dateTimeBetween('-1 month'),
            'paid_period_thru' => function ($data) {
                return carbon($data['paid_period_from'])->addMonthNoOverflow();
            },
        ];
    }
}
