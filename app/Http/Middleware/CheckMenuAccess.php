<?php

namespace App\Http\Middleware;

use App\Models\Subscription;
use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use InfyOm\Generator\Utils\ResponseUtil;

class CheckMenuAccess
{
    /**
     * Handle an incoming request.
     *
     * @param  Request  $request
     * @param  Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (getLoggedInUser()->hasRole('Super Admin')) {
            return redirect('super-admin/dashboard');
        }

        $currentRouteName = $request->route()->getName();
        $authUser = getLoggedInUser();
        if (! $authUser->hasRole('Admin')) {
            $authUser = User::withoutGlobalScope(new \Stancl\Tenancy\Database\TenantScope())
                ->where('tenant_id', $authUser->owner->tenant_id)->first();
        }

        $subscription = Subscription::with('subscriptionPlan.planFeatures')
            ->where('status', Subscription::ACTIVE)
            ->where('user_id', $authUser->id)->first();

        $featureDefault = DB::table('features')->where('is_default', 1)->whereJsonContains('route->route_name',
            [$currentRouteName])->first();

        if (! empty($featureDefault)) {
            return $next($request);
        }

        $subscriptionPlanFeaturesId = $subscription->subscriptionPlan->planFeatures->pluck('feature_id')->toArray();

        $feature = DB::table('features')->whereJsonContains('route->route_name', [$currentRouteName])->first();
        $featureId = $feature->id;
        if ($feature->has_parent != 0) {
            $featureId = $feature->has_parent;
        }

        if ($feature != null && in_array($featureId, $subscriptionPlanFeaturesId)) {
            return $next($request);
        }

        if ($request->ajax()) {
            return response()->json(ResponseUtil::makeError('Opps, the requested feature is not available within your hospital.'),
                404);
        }

        return redirect()->route('feature.available');
    }
}
