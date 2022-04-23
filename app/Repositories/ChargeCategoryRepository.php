<?php

namespace App\Repositories;

use App\Models\ChargeCategory;

/**
 * Class ChargeCategoryRepository
 * @version April 11, 2020, 5:26 am UTC
 */
class ChargeCategoryRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'description',
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
        return ChargeCategory::class;
    }
}
