<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAmbulanceCallsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ambulance_calls', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('patient_id');
            $table->unsignedInteger('ambulance_id');
            $table->string('driver_name');
            $table->date('date');
            $table->double('amount', 8, 2);
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
            $table->foreign('ambulance_id')->references('id')->on('ambulances')
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
        Schema::drop('ambulance_calls');
    }
}
