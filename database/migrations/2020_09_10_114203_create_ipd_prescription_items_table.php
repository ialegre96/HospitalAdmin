<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateIpdPrescriptionItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ipd_prescription_items', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('ipd_prescription_id');
            $table->unsignedInteger('category_id');
            $table->unsignedInteger('medicine_id');
            $table->string('dosage');
            $table->text('instruction');
            $table->string('tenant_id')->nullable();
            $table->timestamps();

            $table->foreign('tenant_id')
                ->references('id')
                ->on('tenants')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreign('ipd_prescription_id')->references('id')->on('ipd_prescriptions')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('category_id')->references('id')->on('categories')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('medicine_id')->references('id')->on('medicines')
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
        Schema::dropIfExists('ipd_prescription_items');
    }
}
