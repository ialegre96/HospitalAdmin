<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateIpdConsultantRegistersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ipd_consultant_registers', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('ipd_patient_department_id');
            $table->dateTime('applied_date');
            $table->unsignedBigInteger('doctor_id');
            $table->text('instruction');
            $table->date('instruction_date');
            $table->string('tenant_id')->nullable();
            $table->timestamps();

            $table->foreign('tenant_id')
                ->references('id')
                ->on('tenants')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreign('ipd_patient_department_id')->references('id')->on('ipd_patient_departments')
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
        Schema::drop('ipd_consultant_registers');
    }
}
