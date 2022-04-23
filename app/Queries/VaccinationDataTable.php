<?php

namespace App\Queries;

use App\Models\Vaccination;
use Illuminate\Database\Query\Builder;

/**
 * Class VaccinationDataTable
 */
class VaccinationDataTable
{
    /**
     * @return Builder
     */
    public function get()
    {
        return Vaccination::select('vaccinations.*');
    }
}
