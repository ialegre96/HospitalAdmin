<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIndexToBedAssignsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('bed_assigns', function (Blueprint $table) {
            $table->index(['created_at', 'assign_date']);
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
            $table->dropIndex('bed_assigns_created_at_assign_date_index');
        });
    }
}
