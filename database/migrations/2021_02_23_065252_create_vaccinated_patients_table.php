<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVaccinatedPatientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vaccinated_patients', function (Blueprint $table) {
            $table->increments('id')->index();
            $table->unsignedInteger('patient_id')->index();
            $table->unsignedInteger('vaccination_id')->index();
            $table->string('vaccination_serial_number')->nullable();
            $table->string('dose_number');
            $table->dateTime('dose_given_date');
            $table->text('description')->nullable();
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

            $table->foreign('vaccination_id')->references('id')->on('vaccinations')
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
        Schema::dropIfExists('vaccinations');
    }
}
