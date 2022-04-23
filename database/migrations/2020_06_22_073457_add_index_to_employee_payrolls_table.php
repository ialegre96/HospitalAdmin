<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIndexToEmployeePayrollsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('employee_payrolls', function (Blueprint $table) {
            $table->index(['id', 'sr_no']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('employee_payrolls', function (Blueprint $table) {
            $table->dropIndex('employee_payrolls_id_sr_no_index');
        });
    }
}
