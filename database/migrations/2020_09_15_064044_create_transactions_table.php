<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->string('transaction_id');
            $table->integer('payment_type')->comment('1 = Stripe, 2 = Paypal');
            $table->float('amount');
            $table->unsignedBigInteger('user_id');
            $table->string('status');
            $table->text('meta')->nullable();
            $table->string('tenant_id')->nullable();
            $table->timestamps();

            $table->index('transaction_id');
            $table->index('payment_type');
            $table->index('amount');
            $table->index('user_id');
            $table->index('status');

            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreign('tenant_id')
                ->references('id')
                ->on('tenants')
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
        Schema::dropIfExists('transactions');
    }
}
