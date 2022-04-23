<?php

namespace App\Repositories;

use App\Models\Charge;

/**
 * Class ChargeRepository
 * @version April 11, 2020, 9:09 am UTC
 */
class ChargeRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'standard_charge',
        'code',
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
        return Charge::class;
    }
}
