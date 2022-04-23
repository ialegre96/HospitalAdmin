<?php

namespace App\Repositories;

use App\Models\DiagnosisCategory;

/**
 * Class DiagnosisCategoryRepository
 */
class DiagnosisCategoryRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'description',
    ];

    /**
     * @return array|string[]
     */
    public function getFieldsSearchable()
    {
        return $this->fieldSearchable;
    }

    /**
     * @return string
     */
    public function model()
    {
        return DiagnosisCategory::class;
    }
}
