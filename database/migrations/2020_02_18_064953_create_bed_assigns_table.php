<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateBedAssignsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bed_assigns', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('bed_id');
            $table->unsignedInteger('patient_id');
            $table->string('case_id');
            $table->date('assign_date');
            $table->date('discharge_date')->nullable();
            $table->text('description')->nullable();
            $table->boolean('status')->default(0);
            $table->string('tenant_id')->nullable();
            $table->timestamps();

            $table->foreign('tenant_id')
                ->references('id')
                ->on('tenants')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreign('bed_id')->references('id')->on('beds')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreign('patient_id')->references('id')->on('patients')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('bed_assigns');
    }
}
