<?php

namespace App\Queries;

use App\Models\Payment;
use Illuminate\Database\Query\Builder;

/**
 * Class PaymentDataTable
 */
class PaymentDataTable
{
    /**
     * @return Payment|Builder
     */
    public function get()
    {
        /** @var Payment $query */
        $query = Payment::with('account')->select('payments.*');

        return $query;
    }
}
