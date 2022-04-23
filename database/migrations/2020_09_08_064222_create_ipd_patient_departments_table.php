<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateIpdPatientDepartmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ipd_patient_departments', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('patient_id');
            $table->string('ipd_number')->unique();
            $table->string('height')->nullable();
            $table->string('weight')->nullable();
            $table->string('bp')->nullable();
            $table->text('symptoms')->nullable();
            $table->text('notes')->nullable();
            $table->datetime('admission_date');
            $table->unsignedInteger('case_id');
            $table->boolean('is_old_patient')->nullable()->default(false);
            $table->unsignedBigInteger('doctor_id')->nullable();
            $table->unsignedInteger('bed_type_id')->nullable();
            $table->unsignedInteger('bed_id');
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

            $table->foreign('case_id')->references('id')->on('patient_cases')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('doctor_id')->references('id')->on('doctors')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('bed_type_id')->references('id')->on('bed_types')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('bed_id')->references('id')->on('beds')
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
        Schema::drop('ipd_patient_departments');
    }
}
