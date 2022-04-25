<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFromtoInTransferLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('transfer_logs', function (Blueprint $table) {
            $table->after('member_id', function (Blueprint $table) {
                $table->timestamp('from')->nullable()->index();
                $table->timestamp('to')->nullable()->index();
            });
        });
    }
}
