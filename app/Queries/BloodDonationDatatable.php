<?php

namespace App\Queries;

use App\Models\BloodDonation;

/**
 * Class BloodDonationDatatable
 */
class BloodDonationDatatable
{
    /**
     * @return BloodDonation
     */
    public function get()
    {
        /** @var BloodDonation $query */
        $query = BloodDonation::with(['blooddonor'])->select('blood_donations.*');

        return $query;
    }
}
