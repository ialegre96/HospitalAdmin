<?php

namespace App\Repositories;

use App\Models\Account;
use App\Models\Payment;

/**
 * Class PaymentRepository
 * @version February 22, 2020, 7:06 am UTC
 */
class PaymentRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'payment_date',
        'account_id',
        'pay_to',
        'amount',
    ];

    /**
     * Return searchable fields
     *
     * @return array
     */
    public function getFieldsSearchable()
    {
        return $this->fieldSearchable;
    }

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Payment::class;
    }

    /**
     * @return Account
     */
    public function getAccounts()
    {
        /** @var Account $accounts */
        $accounts = Account::where('status', '=', 1)->pluck('name', 'id')->sort();

        return $accounts;
    }
}
