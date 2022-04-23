<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIndexToRadiologyTestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('radiology_tests', function (Blueprint $table) {
            $table->index('test_name');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('radiology_tests', function (Blueprint $table) {
            $table->dropIndex('radiology_tests_test_name_index');
        });
    }
}
