<?php

namespace App\Queries;

use App\Models\Subscription;
use App\Models\Transaction;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

/**
 * Class TransactionDataTable
 */
class SubscriptionDataTable
{
    /**
     * @param array $input
     *
     * @return Builder[]|Collection
     */
    public function get($input = [])
    {
        /** @var Transaction $ery */
        $query = Subscription::with(['subscriptionPlan', 'user'])
            ->groupBy('user_id')
            ->orderBy('user_id', 'DESC');

        $query->when(isset($input['status']),
            function (Builder $q) use ($input) {
                $q->where('status', $input['status']);
            });
        $query->when(isset($input['plan_frequency']),
            function (Builder $q) use ($input) {
                $q->where('plan_frequency', $input['plan_frequency']);
            });

        return $query->get();
    }
}
