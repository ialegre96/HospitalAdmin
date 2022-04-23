<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateIpdTimelinesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ipd_timelines', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('ipd_patient_department_id');
            $table->string('title');
            $table->date('date');
            $table->text('description')->nullable();
            $table->boolean('visible_to_person')->default(true);
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
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('ipd_timelines');
    }
}
