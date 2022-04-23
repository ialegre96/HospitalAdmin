<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddIpdPatientDepartmentIdToBedAssignsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('bed_assigns', function (Blueprint $table) {
            $table->unsignedInteger('ipd_patient_department_id')->nullable()->after('bed_id');

            $table->foreign('ipd_patient_department_id')->references('id')->on('ipd_patient_departments')
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
        Schema::table('bed_assigns', function (Blueprint $table) {
            $table->dropColumn('ipd_patient_department_id');
        });
    }
}
