<?php

namespace App\Repositories;

use App\Models\Vaccination;

/**
 * Class VaccinationRepository
 * @version March 31, 2020, 12:22 pm UTC
 */
class VaccinationRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'manufactured_by',
        'brand',
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
        return Vaccination::class;
    }
}
