<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInsuranceDiseaseTable extends Migration
{
    /**
     * Run the migrations.
     * @return void
     */
    public function up()
    {
        Schema::create('insurance_diseases', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('insurance_id');
            $table->string('disease_name');
            $table->double('disease_charge');
            $table->timestamps();

            $table->foreign('insurance_id')->references('id')->on('insurances')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('insurance_diseases');
    }
}
