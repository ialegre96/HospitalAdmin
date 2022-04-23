<?php

namespace App\Repositories;

use App\Models\Doctor;
use App\Models\DoctorOPDCharge;

/**
 * Class DoctorOPDChargeRepository
 */
class DoctorOPDChargeRepository extends BaseRepository
{
    /**
     * @var string[]
     */
    protected $fieldSearchable = [
        'doctor_id',
        'standard_charge',
    ];

    /**
     * @return array|string[]
     */
    public function getFieldsSearchable()
    {
        return $this->fieldSearchable;
    }

    /**
     * Configure the Model
     */
    public function model()
    {
        return DoctorOPDCharge::class;
    }

    /**
     * @return Doctor
     */
    public function getDoctors()
    {
        /** @var Doctor $doctors */
        $doctors = Doctor::with('user')->get()->where('user.status', '=', 1)->pluck('user.full_name', 'id')->sort();

        return $doctors;
    }
}
