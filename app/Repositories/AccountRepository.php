<?php

namespace App\Repositories;

use App\Models\Account;

/**
 * Class AccountRepository
 * @version February 21, 2020, 9:54 am UTC
 */
class AccountRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'type',
        'description',
        'status',
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
        return Account::class;
    }
}
