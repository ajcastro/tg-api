<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIsShownInBannerInPromotionSettings extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('banner_in_promotion_settings', function (Blueprint $table) {
            $table->boolean('is_shown_in_banner')->default(0)->after('is_lock_withdrawal');
        });
    }
}
