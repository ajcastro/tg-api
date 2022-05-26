<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProfitLossByMembersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profit_loss_by_members', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('website_id')->index();
            $table->unsignedBigInteger('member_id')->index();
            $table->unsignedBigInteger('provider_id')->index();
            $table->unsignedBigInteger('game_id')->index();
            $table->timestamp('datetime')->index();
            $table->unsignedBigInteger('deposit_count')->default(0);
            $table->decimal('deposit_amount', 15, 2)->default(0);
            $table->unsignedBigInteger('withdraw_count')->default(0);
            $table->decimal('withdraw_amount', 15, 2)->default(0);
            $table->unsignedBigInteger('adjustment_count')->default(0);
            $table->decimal('adjustment_amount', 15, 2)->default(0);
            $table->unsignedBigInteger('bet_count')->default(0);
            $table->decimal('bet_amount', 15, 2)->default(0);
            $table->unsignedBigInteger('bonus_count')->default(0);
            $table->decimal('bonus_amount', 15, 2)->default(0);
            $table->decimal('vba', 15, 2)->default(0);
            $table->decimal('win_loss', 15, 2)->default(0)->comment('formerly called result_amount');
            $table->decimal('share_upline', 15, 2)->default(0);
            $table->decimal('share_downline', 15, 2)->default(0);
            $table->decimal('referral', 15, 2)->default(0);
            $table->decimal('commission', 15, 2)->default(0);
            $table->decimal('progressive', 15, 2)->default(0);
            $table->decimal('total_win_loss', 15, 2)->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('profit_loss_by_members');
    }
}
