<?php

namespace App\Queries;

use App\Models\Testimonial;
use Illuminate\Database\Eloquent\Builder;

/**
 * Class TestimonialDatatable.
 */
class TestimonialDatatable
{
    /**
     * @return Testimonial|Builder
     */
    public function get()
    {
        /** @var testimonial $query */
        $query = Testimonial::query()->select('testimonials.*');

        return $query;
    }
}
