<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePrescriptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('prescriptions', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('patient_id');
            $table->unsignedBigInteger('doctor_id')->nullable();
            $table->string('food_allergies')->nullable();
            $table->string('tendency_bleed')->nullable();
            $table->string('heart_disease')->nullable();
            $table->string('high_blood_pressure')->nullable();
            $table->string('diabetic')->nullable();
            $table->string('surgery')->nullable();
            $table->string('accident')->nullable();
            $table->string('others')->nullable();
            $table->string('medical_history')->nullable();
            $table->string('current_medication')->nullable();
            $table->string('female_pregnancy')->nullable();
            $table->string('breast_feeding')->nullable();
            $table->string('health_insurance')->nullable();
            $table->string('low_income')->nullable();
            $table->string('reference')->nullable();
            $table->boolean('status')->nullable();
            $table->string('tenant_id')->nullable();
            $table->timestamps();

            $table->foreign('tenant_id')
                ->references('id')
                ->on('tenants')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreign('patient_id')->references('id')->on('patients')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('doctor_id')->references('id')->on('doctors')
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
        Schema::drop('prescriptions');
    }
}
