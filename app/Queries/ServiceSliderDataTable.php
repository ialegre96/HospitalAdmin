<?php

namespace App\Queries;

use App\Models\ServiceSlider;
use Illuminate\Database\Query\Builder;

/**
 * Class ServiceSliderDataTable
 */
class ServiceSliderDataTable
{
    /**
     * @return ServiceSlider|\Illuminate\Database\Eloquent\Builder|Builder
     */
    public function get()
    {
        return ServiceSlider::query()->select('service_sliders.*');
    }
}
