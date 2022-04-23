<?php

namespace Database\Seeders;

use App\Models\Feature;
use App\Models\SubscriptionPlan;
use Illuminate\Database\Seeder;

class DefaultSubscriptionPlanTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $input = [
            'name'       => 'Standard',
            'currency'   => 'usd',
            'price'      => 10,
            'frequency'  => SubscriptionPlan::MONTH,
            'is_default' => 1,
            'trial_days' => 7,
        ];

        $subscriptionPlan = SubscriptionPlan::create($input);
        $planFeatures = Feature::HasParent()->IsDefault()->get();
        $planFeaturesIds = null;
        foreach ($planFeatures as $planFeature) {
            $planFeaturesIds[] = $planFeature->id;
        }

        $subscriptionPlan->features()->sync($planFeaturesIds);
    }
}
