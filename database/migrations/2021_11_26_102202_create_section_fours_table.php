<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSectionFoursTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('section_fours', function (Blueprint $table) {
            $table->id();
            $table->string('text_main', 30);
            $table->string('text_secondary', 160);
            $table->string('img_url_one');
            $table->string('img_url_two');
            $table->string('img_url_three');
            $table->string('img_url_four');
            $table->string('img_url_five');
            $table->string('img_url_six');
            $table->string('card_text_one', 20);
            $table->string('card_text_two', 20);
            $table->string('card_text_three', 20);
            $table->string('card_text_four', 20);
            $table->string('card_text_five', 20);
            $table->string('card_text_six', 20);
            $table->string('card_text_one_secondary', 100);
            $table->string('card_text_two_secondary', 100);
            $table->string('card_text_three_secondary', 100);
            $table->string('card_text_four_secondary', 100);
            $table->string('card_text_five_secondary', 100);
            $table->string('card_text_six_secondary', 100);
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
        Schema::dropIfExists('section_fours');
    }
}
