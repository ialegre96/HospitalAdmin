<?php

namespace App\Repositories;

use App\Models\PathologyCategory;

/**
 * Class PathologyCategoryRepository
 * @version April 11, 2020, 5:39 am UTC
 */
class PathologyCategoryRepository extends BaseRepository
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
        return PathologyCategory::class;
    }
}
