<?php

namespace App\Http\Controllers;

use App\Models\Subscription;
use App\Models\SubscriptionPlan;
use App\Models\Transaction;
use App\Repositories\SubscriptionPlanRepository;
use Arr;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Laracasts\Flash\Flash;

class SubscriptionPricingPlanController extends Controller
{
    /**
     * @var
     */
    private $subscriptionPlanRepository;

    /**
     * @param  SubscriptionPlanRepository  $subscriptionPlanRepo
     */
    public function __construct(SubscriptionPlanRepository $subscriptionPlanRepo)
    {
        $this->subscriptionPlanRepository = $subscriptionPlanRepo;
    }

    /**
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        $data = $this->subscriptionPlanRepository->getSubscriptionPlansData();

        return view('subscription_pricing_plans.index')->with($data);
    }

    public function choosePaymentType($planId, $context = null, $fromScreen = null)
    {
        // code for checking the current plan is active or not, if active then it should not allow to choose that plan
        $subscription = Subscription::with('subscriptionPlan')->where('status', Subscription::ACTIVE)->where('user_id',
            \Auth::user()->id)->first();
        if ($subscription->subscriptionPlan->id == $planId) {
            $toastData = [
                'toastType'    => 'warning',
                'toastMessage' => $subscription->subscriptionPlan->name.' '.__('messages.subscription_pricing_plans.has_already_been_subscribed'),
            ];

            if ($context != null && $context == 'landing') {
                if ($fromScreen == 'landing.home') {
                    return redirect(route('landing.home'))->with('toast-data', $toastData);
                } elseif ($fromScreen == 'landing.about.us') {
                    return redirect(route('landing.about.us'))->with('toast-data', $toastData);
                } elseif ($fromScreen == 'landing.services') {
                    return redirect(route('landing.services'))->with('toast-data', $toastData);
                } elseif ($fromScreen == 'landing.pricing') {
                    return redirect(route('landing.pricing'))->with('toast-data', $toastData);
                }
            }
        }

        $subscriptionsPricingPlan = SubscriptionPlan::findOrFail($planId);
        $paymentTypes = Arr::except(Subscription::PAYMENT_TYPES, [Subscription::TYPE_FREE]);
        $transction = Transaction::where('user_id', getLoggedInUserId())
            ->where('payment_type', Transaction::TYPE_CASH)
            ->where('status', 0)
            ->where('is_manual_payment', 0)->latest()->exists();

        if ($context != null && $context == 'landing') {
            if ($transction) {
                Flash::success('Your Manual Transaction Requests pending.');

                return view('landing.landing_pricing_plan.payment_for_subscription_plan',
                    compact('subscriptionsPricingPlan', 'paymentTypes', 'fromScreen', 'transction'));
            } else {
                return view('landing.landing_pricing_plan.payment_for_subscription_plan',
                    compact('subscriptionsPricingPlan', 'paymentTypes', 'fromScreen', 'transction'));
            }
        }
        $paymentTypes = Arr::except($paymentTypes, 0);

        if ($transction) {

            Flash::success('Your Manual Transaction Requests pending.');

            return view('subscription_pricing_plans.payment_for_plan',
                compact('subscriptionsPricingPlan', 'paymentTypes', 'transction'));
        } else {
            return view('subscription_pricing_plans.payment_for_plan',
                compact('subscriptionsPricingPlan', 'paymentTypes', 'transction'));
        }
    }
}
