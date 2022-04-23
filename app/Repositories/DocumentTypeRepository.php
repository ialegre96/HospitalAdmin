<?php

namespace App\Repositories;

use App\Models\DocumentType;

/**
 * Class DocumentTypeRepository
 * @version February 18, 2020, 4:24 am UTC
 */
class DocumentTypeRepository extends BaseRepository
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
        return DocumentType::class;
    }
}
