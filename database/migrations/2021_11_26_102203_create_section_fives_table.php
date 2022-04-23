<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSectionFivesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('section_fives', function (Blueprint $table) {
            $table->id();
            $table->string('main_img_url');
            $table->string('card_img_url_one');
            $table->string('card_img_url_two');
            $table->string('card_img_url_three');
            $table->string('card_img_url_four');
            $table->integer('card_one_number');
            $table->integer('card_two_number');
            $table->integer('card_three_number');
            $table->integer('card_four_number');
            $table->string('card_one_text', 15);
            $table->string('card_two_text', 15);
            $table->string('card_three_text', 15);
            $table->string('card_four_text', 15);
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
        Schema::dropIfExists('section_fives');
    }
}
