<?php

namespace App\Queries;

use App\Models\DoctorOPDCharge;
use Illuminate\Database\Query\Builder;

/**
 * Class DoctorOPDChargeDataTable
 */
class DoctorOPDChargeDataTable
{
    /**
     * @return DoctorOPDCharge|Builder
     */
    public function get()
    {
        /** @var DoctorOPDCharge $query */
        $query = DoctorOPDCharge::whereHas('doctor.user')->with('doctor.user')->select('doctor_opd_charges.*')
            ->orderBy('created_at', 'desc');

        return $query;
    }
}
