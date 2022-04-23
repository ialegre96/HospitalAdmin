<?php

namespace App\Queries;

use App\Models\Subscribe;

/**
 * Class SubscriberDataTable
 */
class SubscriberDataTable
{
    /**
     * @return Subscribe
     */
    public function get()
    {
        /** @var Subscribe $query */
        $query = Subscribe::select('subscribes.*');

        return $query;
    }
}
