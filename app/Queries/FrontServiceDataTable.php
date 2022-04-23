<?php

namespace App\Queries;

use App\Models\FrontService;

/**
 * Class FrontServiceDataTable
 */
class FrontServiceDataTable
{
    /**
     * @param array $input
     *
     * @return FrontService
     */
    public function get($input = [])
    {
        /** @var FrontService $query */
        $query = FrontService::query()->select('front_services.*')->with('media');

        return $query;
    }
}
