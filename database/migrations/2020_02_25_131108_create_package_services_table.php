<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePackageServicesTable extends Migration
{
    /**
     * Run the migrations.
     * @return void
     */
    public function up()
    {
        Schema::create('package_services', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('package_id');
            $table->unsignedInteger('service_id');
            $table->double('quantity');
            $table->double('rate');
            $table->double('amount');
            $table->timestamps();

            $table->foreign('package_id')->references('id')->on('packages')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreign('service_id')->references('id')->on('services')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('package_services');
    }
}
