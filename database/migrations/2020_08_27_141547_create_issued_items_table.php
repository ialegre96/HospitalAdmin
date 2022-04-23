<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIssuedItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('issued_items', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedBigInteger('department_id');
            $table->unsignedBigInteger('user_id');
            $table->string('issued_by');
            $table->date('issued_date');
            $table->date('return_date')->nullable();
            $table->unsignedInteger('item_category_id');
            $table->unsignedInteger('item_id');
            $table->integer('quantity');
            $table->text('description')->nullable();
            $table->boolean('status')->nullable()->default(false);
            $table->string('tenant_id')->nullable();
            $table->timestamps();

            $table->foreign('tenant_id')
                ->references('id')
                ->on('tenants')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreign('department_id')->references('id')->on('departments')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('user_id')->references('id')->on('users')
                ->onDelete('cascade')
                ->onUpdate('cascade');

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
        Schema::drop('issued_items');
    }
}
