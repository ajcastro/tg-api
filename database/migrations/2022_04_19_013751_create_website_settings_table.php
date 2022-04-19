<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWebsiteSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('website_settings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('website_id')->index();
            $table->string('title');
            $table->string('brand_name');
            $table->string('logo')->nullable();
            $table->string('favicon')->nullable();
            $table->string('jackpot_image')->nullable();
            $table->string('running_text_announcement')->nullable();
            $table->string('livechat_url')->nullable();
            $table->string('livechat_code')->nullable();
            $table->boolean('on_maintenance_mode')->default(0);
            $table->string('timezone')->nullable();
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
        Schema::dropIfExists('website_settings');
    }
}
