<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBloodIssuesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blood_issues', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->dateTime('issue_date');
            $table->unsignedBigInteger('doctor_id');
            $table->unsignedInteger('donor_id');
            $table->unsignedInteger('patient_id');
            $table->string('amount')->nullable();
            $table->text('remarks')->nullable();
            $table->string('tenant_id')->nullable();
            $table->timestamps();

            $table->foreign('tenant_id')
                ->references('id')
                ->on('tenants')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreign('doctor_id')->references('id')->on('doctors')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('donor_id')->references('id')->on('blood_donors')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('patient_id')->references('id')->on('patients')
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
        Schema::dropIfExists('blood_issues');
    }
}
