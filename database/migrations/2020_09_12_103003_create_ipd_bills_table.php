<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIpdBillsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ipd_bills', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('ipd_patient_department_id');
            $table->integer('total_charges');
            $table->integer('total_payments');
            $table->integer('gross_total');
            $table->integer('discount_in_percentage');
            $table->integer('tax_in_percentage');
            $table->integer('other_charges');
            $table->integer('net_payable_amount');
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
        Schema::dropIfExists('ipd_bills');
    }
}
