<?php

namespace App\Http\Middleware;

use App\Models\Subscription;
use Carbon\Carbon;
use Closure;
use Illuminate\Http\Request;
use Laracasts\Flash\Flash;
use Laravel\Cashier\Cashier;
use Stripe\Subscription as StripeSubscription;

class CheckSubscription
{
    /**
     * Handle an incoming request.
     *
     * @param  Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (\Auth::check() && \Auth::user()->hasRole('Super Admin') || ! \Auth::check()) {
            return $next($request);
        }

        if (\Auth::check() && ! \Auth::user()->hasRole('Admin') || ! \Auth::check()) {
            return $next($request);
        }

        $subscription = Subscription::with('subscriptionPlan')
            ->where('status', Subscription::ACTIVE)
            ->where('user_id', \Auth::user()->id)
            ->first();

        if (! $subscription) {
            return redirect()->route('subscription.pricing.plans.index');
        }

        if ($subscription->isExpired()) {
            return redirect()->route('subscription.pricing.plans.index');
        }

//        $now = Carbon::parse(Carbon::now())->format('Y-m-d');
//        $endDate = Carbon::parse($subscription->end_date);
//        $diffInDays = $endDate->diffInDays($now);
//
//        if ($diffInDays == 0) {
//            return redirect()->route('subscription.pricing.plans.index');
//        }


        return $next($request);
    }
}
