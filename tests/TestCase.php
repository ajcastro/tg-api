<?php

namespace Tests;

use AjCastro\PostmanTdd\Tests\PostmanTddSetup;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Tests\Traits\WithDefaultClientActingUser;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication, PostmanTddSetup;

    public function setUp(): void
    {
        parent::setUp();

        $this->setUpPostmanTdd();
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
