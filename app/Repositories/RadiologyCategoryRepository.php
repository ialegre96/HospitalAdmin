<?php

namespace App\Repositories;

use App\Models\RadiologyCategory;

/**
 * Class RadiologyCategoryRepository
 * @version April 11, 2020, 7:08 am UTC
 */
class RadiologyCategoryRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
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
        return RadiologyCategory::class;
    }
}
