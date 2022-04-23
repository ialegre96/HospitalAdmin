<?php

namespace App\Queries;

use App\Models\Medicine;

/**
 * Class DepartmentsDataTable
 */
class MedicinesDataTable
{
    /**
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function get()
    {
        return Medicine::with('brand')->select('medicines.*');
    }
}
