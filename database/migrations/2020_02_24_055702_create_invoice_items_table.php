<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateInvoiceItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoice_items', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('account_id');
            $table->unsignedInteger('invoice_id');
            $table->string('description')->nullable();
            $table->integer('quantity');
            $table->double('price', 8, 2);
            $table->double('total', 8, 2);
            $table->timestamps();

            $table->foreign('account_id')->references('id')->on('accounts')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreign('invoice_id')->references('id')->on('invoices')
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
        Schema::drop('invoice_items');
    }
}
