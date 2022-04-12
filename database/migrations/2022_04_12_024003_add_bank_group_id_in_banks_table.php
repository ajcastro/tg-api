<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddBankGroupIdInBanksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('banks', function (Blueprint $table) {
            $table->foreignId('bank_group_id')->after('id')->index();
            $table->dropColumn('website_id');
            $table->dropColumn('group');
            $table->dropColumn('is_require_account_no');
        });
    }
}
