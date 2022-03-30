<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddImageAndImageThumbInPromotionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('promotions', function (Blueprint $table) {
            $table->after('slug', function (Blueprint $table) {
                $table->string('image')->nullable();
                $table->string('image_thumb')->nullable();
            });

            $table->dropColumn('imgloc');
        });
    }
}
