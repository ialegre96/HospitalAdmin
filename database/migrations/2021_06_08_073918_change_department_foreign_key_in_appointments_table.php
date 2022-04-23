<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeDepartmentForeignKeyInAppointmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('appointments', function (Blueprint $table) {
            $table->dropForeign('appointments_department_id_foreign');
        });

        Schema::table('appointments', function (Blueprint $table) {
            $table->unsignedBigInteger('department_id')->change();
        });

        Schema::table('appointments', function (Blueprint $table) {
            $table->foreign('department_id')->references('id')->on('doctor_departments')
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
        Schema::table('appointments', function (Blueprint $table) {
            //
        });
    }
}
