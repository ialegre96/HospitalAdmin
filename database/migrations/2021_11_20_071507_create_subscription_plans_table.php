<?php

use App\Models\SubscriptionPlan;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubscriptionPlansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subscription_plans', function (Blueprint $table) {
            $table->id();
            $table->string('currency')->nullable()->default('usd');
            $table->string('name');
            $table->float('price')->nullable()->default(0);
            $table->integer('frequency')->default(SubscriptionPlan::MONTH)->comment('1 = Month, 2 = Year');
            $table->integer('is_default')->default(0);
            $table->integer('trial_days')->default(0)->comment('Default validity will be '.SubscriptionPlan::TRAIL_DAYS.' trial days');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('subscription_plans');
    }
}
