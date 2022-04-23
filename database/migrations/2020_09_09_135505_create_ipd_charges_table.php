<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateIpdChargesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ipd_charges', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('ipd_patient_department_id');
            $table->date('date');
            $table->integer('charge_type_id');
            $table->unsignedInteger('charge_category_id');
            $table->unsignedInteger('charge_id');
            $table->integer('standard_charge')->nullable();
            $table->integer('applied_charge');
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

            $table->foreign('charge_category_id')->references('id')->on('charge_categories')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('charge_id')->references('id')->on('charges')
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
        Schema::drop('ipd_charges');
    }
}
