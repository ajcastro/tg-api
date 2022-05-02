<?php

namespace Tests\Unit\Models\MarketWebsite;

use App\Models\MarketWebsite;
use PHPUnit\Framework\TestCase;

class SetResultDayTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_set_result_day_attribute()
    {
        $mw = new MarketWebsite();
        $mw->result_day = ['Monday', 'Tuesday'];

        $this->assertEquals([
            'Wednesday',
            'Thursday',
            'Friday',
            'Saturday',
            'Sunday',
        ], $mw->off_day);

        $this->assertEquals([
            'Monday', 'Tuesday'
        ], $mw->result_day);
    }
}
