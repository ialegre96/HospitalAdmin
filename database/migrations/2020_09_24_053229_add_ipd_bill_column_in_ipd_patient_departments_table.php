<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIpdBillColumnInIpdPatientDepartmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ipd_patient_departments', function (Blueprint $table) {
            $table->boolean('bill_status')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('ipd_patient_departments', function (Blueprint $table) {
            Schema::dropColumn('bill_status');
        });
    }
}
