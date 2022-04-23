<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use App\Models\Subscription;
use App\Models\SubscriptionPlan;
use App\Models\Transaction;
use App\Repositories\RazorpayRepository;
use App\Repositories\SubscriptionRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Laracasts\Flash\Flash;

class CashController extends Controller
{

    /**
     * @var SubscriptionRepository
     */
    private $subscriptionRepository;

    /**
     * PaypalController constructor.
     * @param SubscriptionRepository $subscriptionRepository
     */
    public function __construct(SubscriptionRepository $subscriptionRepository)
    {
        $this->subscriptionRepository = $subscriptionRepository;
    }

    /**
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function pay(Request $request)
    {
        $input = $request->all();

        $data = $this->subscriptionRepository->manageCashSubscription($input['plan_id']);

        if (!isset($data['plan'])) { // 0 amount plan or try to switch the plan if it is in trial mode
            // returning from here if the plan is free.
            if (isset($data['status']) && $data['status'] == true) {
                return $this->sendSuccess($data['subscriptionPlan']->name.' '.__('messages.subscription_pricing_plans.has_been_subscribed'));
            } else {
                if (isset($data['status']) && $data['status'] == false) {
                    return $this->sendError('Cannot switch to zero plan if trial is available / having a paid plan which is currently active');
                }
            }
        }

        // If call returns body in response, you can get the deserialized version from the result attribute of the response
        $subscriptionId = $data['subscription']->id;
        $subscriptionAmount = $data['amountToPay'];

        $transaction = Transaction::create([
            'payment_type' => Transaction::TYPE_CASH,
            'amount'       => $subscriptionAmount,
            'user_id'      => getLoggedInUserId(),
            'status'       => Subscription::INACTIVE,
            'tenant_id'    => getLoggedInUser()->tenant_id,
        ]);

        // updating the transaction id on the subscription table
        $subscription = Subscription::with('subscriptionPlan')->findOrFail($subscriptionId);
        $subscription->update(['transaction_id' => $transaction->id]);

        Flash::success(trans('messages.subscription.cash_payment_done', [], getLoggedInUser()->language));

        if ($input['from_pricing'] == 'landing.home') {
            return response()->json(['url' => route('landing.home')]);
        } elseif ($input['from_pricing'] == 'landing.about.us') {
            return response()->json(['url' => route('landing.about.us')]);
        } elseif ($input['from_pricing'] == 'landing.services') {
            return response()->json(['url' => route('landing.services')]);
        } elseif ($input['from_pricing'] == 'landing.pricing') {
            return response()->json(['url' => route('landing.pricing')]);
        } else {
            return response()->json(['url' => route('subscription.pricing.plans.index')]);
        }
    }
}
