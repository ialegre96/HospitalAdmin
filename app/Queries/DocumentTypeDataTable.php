<?php

namespace App\Queries;

use App\Models\DocumentType;
use Illuminate\Database\Eloquent\Builder;

/**
 * Class DocumentTypeDataTable
 */
class DocumentTypeDataTable
{
    /**
     * @return Builder
     */
    public function get()
    {
        $query = DocumentType::query();

        return $query->select('document_types.*');
    }
}
