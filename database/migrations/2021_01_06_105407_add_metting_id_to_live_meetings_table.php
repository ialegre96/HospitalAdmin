<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddMettingIdToLiveMeetingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('live_meetings', function (Blueprint $table) {
            $table->string('meeting_id')->after('meta');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (Schema::hasColumn('meeting_id')) {
            Schema::table('live_meetings', function (Blueprint $table) {
                $table->dropColumn('meeting_id');
            });
        }
    }
}
