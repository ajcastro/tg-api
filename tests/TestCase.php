<?php

namespace Tests;

use App\Models\User;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    protected $withActingUser = false;

    public function setUp(): void
    {
        parent::setUp();

        if ($this->withActingUser && ($user = $this->createActingUser())) {
            $this->actingAs($user);
        }
    }

    public function createActingUser(): ?User
    {
        return User::factory()->create();
    }
}
