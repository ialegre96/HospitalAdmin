<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePatientDiagnosisPropertiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('patient_diagnosis_properties', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedBigInteger('patient_diagnosis_id');
            $table->string('property_name');
            $table->string('property_value');
            $table->timestamps();
            $table->index('created_at');

            $table->foreign('patient_diagnosis_id')->references('id')->on('patient_diagnosis_tests')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('patient_diagnosis_properties');
    }
}
