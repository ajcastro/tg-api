<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMarketLimitSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('market_limit_settings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('market_id')->index();
            $table->unsignedBigInteger('website_id')->index();
            $table->unsignedInteger('limit_line_4d')->default(0);
            $table->unsignedInteger('limit_line_3d')->default(0);
            $table->unsignedInteger('limit_line_2d')->default(0);
            $table->unsignedInteger('limit_line_2d_front')->default(0);
            $table->unsignedInteger('limit_line_2d_middle')->default(0);
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
        Schema::dropIfExists('market_limit_settings');
    }
}
