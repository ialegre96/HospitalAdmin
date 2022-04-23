<?php

namespace App\Queries;

use App\Models\Faqs;
use Illuminate\Database\Eloquent\Builder;

/**
 * Class FaqsDataTable
 */
class FaqsDataTable
{
    /**
     * @return Builder
     */
    public function get()
    {
        return Faqs::query()->select('faqs.*');
    }
}
