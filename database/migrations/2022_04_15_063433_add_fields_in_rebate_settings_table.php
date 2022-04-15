<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldsInRebateSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('rebate_settings', function (Blueprint $table) {
            $table->dropColumn('category_id');
            $table->dropColumn('new_member');
            $table->dropColumn('regular_member');
            $table->after('id', function (Blueprint $table) {
                $table->foreignId('rebate_id')->index();
                $table->foreignId('game_category_id')->index();
                $table->decimal('percentage_level_0', 8, 2)->default(0);
                $table->decimal('percentage_level_1', 8, 2)->default(0);
                $table->decimal('percentage_level_2', 8, 2)->default(0);
            });
        });
    }
}
