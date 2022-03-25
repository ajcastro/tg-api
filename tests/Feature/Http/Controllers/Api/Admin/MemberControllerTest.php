<?php

namespace Tests\Feature\Http\Controllers\Api\Admin;

use App\Models\Member;
use App\Models\MemberBank;
use App\Models\User;
use App\Models\Website;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;
use Tests\Traits\WithDefaultClientActingUser;

/**
 * @see \App\Http\Controllers\Api\Admin\MemberController
 */
class MemberControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker, WithDefaultClientActingUser;

    public function test_index_should_paginate_resource()
    {
        $upline = Member::factory()->has(MemberBank::factory(), 'banks')->create();
        Member::factory()->count(3)
            ->has(MemberBank::factory(), 'banks')
            ->create([
                'upline_referral_id' => $upline->id,
            ]);

        $response = $this->getJson(route('members.index', [
            'include' => 'website,banks,upline_referral,suspended_by,blacklisted_by',
            'fields[upline_referral]' => 'id,referral_number',
        ]));

        $response->assertOk();
        $response->assertJsonStructure([
            'data' => [
                [
                    ...Member::allowableFields(),
                    'website' => Website::allowableFields(),
                    'upline_referral' => ['id', 'referral_number'],
                    'banks' => [MemberBank::allowableFields()],
                ]
            ]
        ]);
    }
}
