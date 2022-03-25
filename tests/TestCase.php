<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Tests\Traits\WithDefaultClientActingUser;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    public function setUp(): void
    {
        parent::setUp();
    }

    protected function setUpTraits()
    {
        parent::setUpTraits();

        if (is_using(static::class, WithDefaultClientActingUser::class)) {
            /** @var WithDefaultClientActingUser $this */
            $this->setUpDefaultClientActingUser();
        }
    }
}
