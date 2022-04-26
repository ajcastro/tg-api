<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_logs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('website_id')->index();
            $table->unsignedBigInteger('user_id')->index();
            $table->timestamp('date')->nullable();
            $table->ipAddress('user_ip')->nullable();
            $table->string('user_info')->nullable();
            $table->unsignedBigInteger('member_id')->index()->nullable();
            $table->string('category')->nullable();
            $table->string('activity')->nullable();
            $table->text('detail')->nullable();
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
        Schema::dropIfExists('user_logs');
    }
}
