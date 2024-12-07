<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFourdGamesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fourd_games', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('market_id')->index();
            $table->unsignedBigInteger('website_id')->index();
            $table->date('date')->index();
            $table->unsignedInteger('period')->index();
            $table->unsignedTinyInteger('num1')->nullable();
            $table->unsignedTinyInteger('num2')->nullable();
            $table->unsignedTinyInteger('num3')->nullable();
            $table->unsignedTinyInteger('num4')->nullable();
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
        Schema::dropIfExists('fourd_games');
    }
}
