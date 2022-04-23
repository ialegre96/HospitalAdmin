<?php

namespace App\Queries;

use App\Models\DiagnosisCategory;

/**
 * Class DiagnosisCategoryDataTable
 */
class DiagnosisCategoryDataTable
{
    public function get()
    {
        /** @var DiagnosisCategory $query */
        $query = DiagnosisCategory::query();

        return $query;
    }
}
