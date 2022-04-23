<?php

namespace App\Repositories;

use App\Models\CallLog;

/**
 * Class CallLogRepository
 * @version July 3, 2020, 9:12 am UTC
 */
class CallLogRepository extends BaseRepository
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
        return CallLog::class;
    }
}
