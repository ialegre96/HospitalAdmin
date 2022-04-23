<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFeatureSubscriptionplanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('feature_subscriptionplan', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('feature_id');
            $table->unsignedBigInteger('subscription_plan_id')->nullable();
            $table->timestamps();

            $table->index(['feature_id', 'subscription_plan_id']);

            $table->foreign('feature_id')->references('id')->on('features')
                ->onUpdate('CASCADE')
                ->onDelete('CASCADE');
            $table->foreign('subscription_plan_id')->references('id')->on('subscription_plans')
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
        Schema::dropIfExists('feature_subscriptionplan');
    }
}
