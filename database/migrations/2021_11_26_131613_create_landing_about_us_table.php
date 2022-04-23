<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLandingAboutUsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('landing_about_us', function (Blueprint $table) {
            $table->id();
            $table->string('text_main',20);
            $table->string('card_img_one');
            $table->string('card_img_two');
            $table->string('card_img_three');
            $table->string('main_img_one');
            $table->string('main_img_two');
            $table->string('card_one_text',20);
            $table->string('card_two_text',20);
            $table->string('card_three_text',20);
            $table->string('card_one_text_secondary',135);
            $table->string('card_two_text_secondary',135);
            $table->string('card_three_text_secondary',135);
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
        Schema::dropIfExists('landing_about_us');
    }
}
