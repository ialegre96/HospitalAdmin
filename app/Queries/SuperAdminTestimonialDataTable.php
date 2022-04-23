<?php

namespace App\Queries;

use App\Models\AdminTestimonial;
use App\Models\Testimonial;

/**
 * Class SuperAdminTestimonialDataTable
 */
class SuperAdminTestimonialDataTable
{
    /**
     * @return Testimonial
     */
    public function get()
    {
        /** @var testimonial $query */
        $query = AdminTestimonial::query()->select('admin_testimonials.*');

        return $query;
    }
}
