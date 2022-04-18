<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReferralLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('referral_logs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('website_id')->index();
            $table->unsignedBigInteger('game_category_id')->index();
            $table->unsignedBigInteger('member_id')->index();
            $table->unsignedBigInteger('uplink_member_id')->index();
            $table->decimal('turn_over_amount', 15, 2)->default(0);
            $table->decimal('referral_percentage', 3, 2)->default(0);
            $table->decimal('referral_amount', 15, 2)->default(0);
            $table->timestamp('paid_period_from')->index()->nullable();
            $table->timestamp('paid_period_thru')->index()->nullable();
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
        Schema::dropIfExists('referral_logs');
    }
}
