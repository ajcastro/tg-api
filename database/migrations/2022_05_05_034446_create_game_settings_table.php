<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGameSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('game_settings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('website_id')->index();
            $table->unsignedBigInteger('game_id')->index();
            $table->integer('min_bet')->default(0);
            $table->integer('max_bet')->default(0);
            $table->decimal('win_multiplier')->default(0);
            $table->decimal('percentage_discount')->default(0);
            $table->decimal('percentage_kei')->default(0);
            $table->integer('limit')->default(0);
            $table->integer('limit_total')->default(0);
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
        Schema::dropIfExists('game_settings');
    }
}
