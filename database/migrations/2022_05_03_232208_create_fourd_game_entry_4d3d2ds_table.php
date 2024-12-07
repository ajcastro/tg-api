<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFourdGameEntry4d3d2dsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fourd_game_entry_4d3d2ds', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('fourd_game_transaction_id')->index();
            $table->unsignedTinyInteger('num1')->nullable();
            $table->unsignedTinyInteger('num2')->nullable();
            $table->unsignedTinyInteger('num3')->nullable();
            $table->unsignedTinyInteger('num4')->nullable();
            $table->string('game')->index()->comment('4d,3d,2d,2d_depan,2d_tengah');
            $table->decimal('bet', 15, 2)->default(0);
            $table->decimal('discount')->default(0);
            $table->decimal('pay', 15, 2)->default(0);
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
        Schema::dropIfExists('fourd_game_entry_4d3d2ds');
    }
}
