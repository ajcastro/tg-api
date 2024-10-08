<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRebatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rebates', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('website_id')->index();
            $table->string('content');
            $table->boolean('is_active')->default(0);
            $table->boolean('is_shown')->default(0);
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
        Schema::dropIfExists('rebates');
    }
}
