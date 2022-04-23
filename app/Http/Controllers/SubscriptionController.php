<?php

namespace App\Http\Controllers;

use App\Repositories\SubscriptionRepository;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Laracasts\Flash\Flash;
use Stripe\Exception\ApiErrorException;

/**
 * Class SubscriptionController
 */
class SubscriptionController extends AppBaseController
{

    /**
     * @var SubscriptionRepository
     */
    private $subscriptionRepo;

    /**
     * @param  SubscriptionRepository  $subscriptionRepo
     */
    public function __construct(SubscriptionRepository $subscriptionRepo)
    {
        $this->subscriptionRepo = $subscriptionRepo;
    }

    /**
     * @param  Request  $request
     *
     * @throws ApiErrorException
     *
     * @return mixed
     */
    public function purchaseSubscription(Request $request)
    {
        $subscriptionPlanId = $request->get('plan_id');
        $result = $this->subscriptionRepo->purchaseSubscriptionForStripe($subscriptionPlanId);

        // returning from here if the plan is free.
        if (isset($result['status']) && $result['status'] == true) {
            return $this->sendSuccess($result['subscriptionPlan']->name.' '.__('messages.subscription_pricing_plans.has_been_subscribed'));
        } else {
            if (isset($result['status']) && $result['status'] == false) {
                return $this->sendError('Cannot switch to zero plan if trial is available / having a paid plan which is currently active');
            }
        }

        return $this->sendResponse($result, 'Session created successfully.');
    }

    /**
     * @param  Request  $request
     *
     * @throws \Stripe\Exception\ApiErrorException
     *
     * @return Application|RedirectResponse|Redirector
     */
    public function paymentSuccess(Request $request)
    {
        /** @var SubscriptionRepository $subscriptionRepo */
        $subscriptionRepo = app(SubscriptionRepository::class);
        $subscription = $subscriptionRepo->paymentUpdate($request);
        Flash::success($subscription->subscriptionPlan->name.' '.__('messages.subscription_pricing_plans.has_been_subscribed'));
        $toastData = [
            'toastType'    => 'success',
            'toastMessage' => $subscription->subscriptionPlan->name.' '.__('messages.subscription_pricing_plans.has_been_subscribed'),
        ];

        if (session('from_pricing') == 'landing.home') {
            return redirect(route('landing.home'))->with('toast-data', $toastData);
        } elseif (session('from_pricing') == 'landing.about.us') {
            return redirect(route('landing.about.us'))->with('toast-data', $toastData);
        } elseif (session('from_pricing') == 'landing.services') {
            return redirect(route('landing.services'))->with('toast-data', $toastData);
        } elseif (session('from_pricing') == 'landing.pricing') {
            return redirect(route('landing.pricing'))->with('toast-data', $toastData);
        } else {
            return redirect(route('subscription.pricing.plans.index'));
        }
    }

    /**
     * @return Application|RedirectResponse|Redirector
     */
    public function handleFailedPayment()
    {
        $subscriptionPlanId = session('subscription_plan_id');
        /** @var SubscriptionRepository $subscriptionRepo */
        $subscriptionRepo = app(SubscriptionRepository::class);
        $subscriptionRepo->paymentFailed($subscriptionPlanId);
        Flash::error('Unable to process the payment at the moment. Try again later.');
        $toastData = [
            'toastType'    => 'error',
            'toastMessage' => 'Unable to process the payment at the moment. Try again later.',
        ];

        if (session('from_pricing') == 'landing.home') {
            return redirect(route('landing.home'))->with('toast-data', $toastData);
        } elseif (session('from_pricing') == 'landing.about.us') {
            return redirect(route('landing.about.us'))->with('toast-data', $toastData);
        } elseif (session('from_pricing') == 'landing.services') {
            return redirect(route('landing.services'))->with('toast-data', $toastData);
        } elseif (session('from_pricing') == 'landing.pricing') {
            return redirect(route('landing.pricing'))->with('toast-data', $toastData);
        } else {
            return redirect(route('subscription.pricing.plans.index'));
        }
    }
}
