<?php

namespace App\Queries;

use App\Models\Account;
use Illuminate\Database\Eloquent\Builder;

/**
 * Class AccountantData
 */
class AccountDataTable
{
    /**
     * @param  array  $input
     *
     * @return Account
     */
    public function get($input = [])
    {
        /** @var Account $query */
        $query = Account::select('accounts.*');

        $query->when(isset($input['account_status']) && $input['account_status'] != Account::ACTIVE_ALL,
            function (Builder $q) use ($input) {
                $q->where('status', $input['account_status']);
            });

        $query->when(isset($input['account_type']) && $input['account_type'] != Account::TYPE_ALL,
            function (Builder $q) use ($input) {
                $q->where('type', $input['account_type']);
            });

        return $query;
    }
}
