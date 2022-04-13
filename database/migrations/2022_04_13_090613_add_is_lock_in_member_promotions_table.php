<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIsLockInMemberPromotionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('member_promotions', function (Blueprint $table) {
            $table->boolean('is_lock')->default(1)->after('member_transaction_id');
        });
    }
}
