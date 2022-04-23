<?php

use App\Models\SubscriptionPlan;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubscriptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subscriptions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('subscription_plan_id')->nullable();
            $table->unsignedBigInteger('transaction_id')->nullable();
            $table->float('plan_amount')->nullable()->default(0);
            $table->integer('plan_frequency')->default(SubscriptionPlan::MONTH)->comment('1 = Month, 2 = Year');
            $table->dateTime('starts_at');
            $table->dateTime('ends_at');
            $table->dateTime('trial_ends_at')->nullable();
            $table->boolean('status')->default(0);
            $table->timestamps();

            $table->index('user_id');
            $table->index('subscription_plan_id');
            $table->index('transaction_id');
            $table->index('plan_amount');
            $table->index('plan_frequency');
            $table->index('starts_at');
            $table->index('ends_at');
            $table->index('trial_ends_at');
            $table->index('status');

            $table->foreign('user_id')->references('id')->on('users')
                ->onUpdate('CASCADE')
                ->onDelete('CASCADE');
            $table->foreign('subscription_plan_id')->references('id')->on('subscription_plans')
                ->onUpdate('CASCADE')
                ->onDelete('CASCADE');
            $table->foreign('transaction_id')->references('id')->on('transactions')
                ->onUpdate('CASCADE')
                ->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('subscriptions');
    }
}
