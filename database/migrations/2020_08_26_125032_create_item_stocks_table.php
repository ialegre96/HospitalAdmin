<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItemStocksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('item_stocks', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('item_category_id');
            $table->unsignedInteger('item_id');
            $table->string('supplier_name')->nullable();
            $table->string('store_name')->nullable();
            $table->integer('quantity');
            $table->double('purchase_price');
            $table->text('description')->nullable();
            $table->string('tenant_id')->nullable();
            $table->timestamps();

            $table->foreign('tenant_id')
                ->references('id')
                ->on('tenants')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreign('item_category_id')->references('id')->on('item_categories')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('item_id')->references('id')->on('items')
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
        Schema::drop('item_stocks');
    }
}
