<?php

namespace Database\Seeders;

use App\Models\Client;
use App\Models\Member;
use App\Models\MemberTransaction;
use App\Models\User;
use App\Models\Website;
use Illuminate\Database\Seeder;

class DummySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (app()->isProduction()) {
            return;
        }

        $this->clean();
        $this->seedDummyMembersAndWebsites();
        $this->seedDummyMemberTransactionsForNewDeposits();
        $this->seedDummyMemberTransactionsForNewWithdrawals();
        $this->seedDummyMemberTransactionsForAdjustments();
    }

    private function clean()
    {
        Website::query()->truncate();
        Member::query()->truncate();
        MemberTransaction::query()->truncate();
    }

    private function seedDummyMembersAndWebsites()
    {
        Website::factory(2)
            ->has(Member::factory(10)->state([
                'suspended_by_id' => null,
                'blacklisted_by_id' => null,
            ]))
            ->create([
                'assigned_client_id' => Client::first()->id,
                'created_by_id' => User::ADMIN_ID,
                'updated_by_id' => User::ADMIN_ID,
            ]);
    }

    private function seedDummyMemberTransactionsForNewDeposits()
    {
        MemberTransaction::factory(30)->create([
            'type' => 'deposit',
            'is_adjustment' => 0,
            'status' => 0,
            'remarks' => '',
            'approved_at' => null,
            'approved_by_id' => null,
        ]);
    }

    private function seedDummyMemberTransactionsForNewWithdrawals()
    {
        MemberTransaction::factory(30)->create([
            'type' => 'withdraw',
            'is_adjustment' => 0,
            'status' => 0,
            'remarks' => '',
            'approved_at' => null,
            'approved_by_id' => null,
        ]);
    }

    private function seedDummyMemberTransactionsForAdjustments()
    {
        MemberTransaction::factory(30)->create([
            'is_adjustment' => 1,
            'status' => 0,
            'remarks' => '',
            'approved_at' => null,
            'approved_by_id' => null,
        ]);
    }
}
