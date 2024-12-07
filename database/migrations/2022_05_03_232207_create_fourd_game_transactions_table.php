<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFourdGameTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fourd_game_transactions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('website_id')->index();
            $table->unsignedBigInteger('fourd_game_id')->index();
            $table->unsignedBigInteger('member_id')->index();
            $table->string('type')->index()->comment('4d3d2d,colok_bebas,5050_umum,dasar,etc...');
            $table->decimal('total_pay', 15, 2)->default(0);
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
        Schema::dropIfExists('fourd_game_transactions');
    }
}
