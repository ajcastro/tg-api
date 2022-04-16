<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRebateLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rebate_logs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('website_id')->index();
            $table->unsignedBigInteger('rebate_id')->index();
            $table->unsignedBigInteger('game_category_id')->index();
            $table->unsignedBigInteger('member_id')->index();
            $table->decimal('turn_over_amount', 15, 2);
            $table->decimal('rebate_percentage', 3, 2);
            $table->decimal('rebate_amount', 15, 2);
            $table->timestamp('paid_period_from')->nullable()->index();
            $table->timestamp('paid_period_thru')->nullable()->index();
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
        Schema::dropIfExists('rebate_logs');
    }
}
