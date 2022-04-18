<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RemoveColumnsInReferralLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('referral_logs', function (Blueprint $table) {
            $table->dropColumn('uplink_member_id');
            $table->dropColumn('game_category_id');
            $table->dropColumn('turn_over_amount');
            $table->dropColumn('referral_percentage');
        });
    }
}
