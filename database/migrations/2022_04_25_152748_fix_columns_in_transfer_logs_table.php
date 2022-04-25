<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class FixColumnsInTransferLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('transfer_logs', function (Blueprint $table) {
            $table->dropColumn('date');
            $table->dropColumn('from');
            $table->dropColumn('to');
        });
    }
}
