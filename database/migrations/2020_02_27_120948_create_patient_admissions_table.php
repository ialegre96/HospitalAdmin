<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePatientAdmissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('patient_admissions', function (Blueprint $table) {
            $table->increments('id');
            $table->string('patient_admission_id')->unique();
            $table->unsignedInteger('patient_id');
            $table->unsignedBigInteger('doctor_id');
            $table->datetime('admission_date');
            $table->datetime('discharge_date')->nullable();
            $table->unsignedInteger('package_id')->nullable();
            $table->unsignedInteger('insurance_id')->nullable();
            $table->unsignedInteger('bed_id')->nullable();
            $table->string('policy_no')->nullable();
            $table->string('agent_name')->nullable();
            $table->string('guardian_name')->nullable();
            $table->string('guardian_relation')->nullable();
            $table->string('guardian_contact')->nullable();
            $table->string('guardian_address')->nullable();
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
            $table->foreign('package_id')->references('id')->on('packages')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->foreign('insurance_id')->references('id')->on('insurances')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->foreign('bed_id')->references('id')->on('beds')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('patient_admissions');
    }
}
