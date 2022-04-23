<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePathologyTestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pathology_tests', function (Blueprint $table) {
            $table->increments('id');
            $table->string('test_name');
            $table->string('short_name');
            $table->string('test_type');
            $table->unsignedInteger('category_id');
            $table->integer('unit')->nullable();
            $table->string('subcategory')->nullable();
            $table->string('method')->nullable();
            $table->integer('report_days')->nullable();
            $table->unsignedInteger('charge_category_id');
            $table->integer('standard_charge');
            $table->string('tenant_id')->nullable();
            $table->timestamps();

            $table->foreign('tenant_id')
                ->references('id')
                ->on('tenants')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreign('category_id')->references('id')->on('pathology_categories')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('charge_category_id')->references('id')->on('charge_categories')
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
        Schema::dropIfExists('pathology_tests');
    }
}
