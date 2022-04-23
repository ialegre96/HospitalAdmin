<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSectionTwosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('section_twos', function (Blueprint $table) {
            $table->id();
            $table->string('text_main', 30);
            $table->string('text_secondary', 160);
            $table->string('card_one_image');
            $table->string('card_one_text', 20);
            $table->string('card_one_text_secondary', 90);
            $table->string('card_two_image');
            $table->string('card_two_text', 20);
            $table->string('card_two_text_secondary', 90);
            $table->string('card_third_image');
            $table->string('card_third_text', 20);
            $table->string('card_third_text_secondary', 90);
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
        Schema::dropIfExists('section_twos');
    }
}
