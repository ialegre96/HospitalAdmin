<?php

namespace App\Repositories;

use App\Models\Bed;
use App\Models\Insurance;
use App\Models\Package;
use App\Models\PatientAdmission;
use Exception;
use Symfony\Component\HttpKernel\Exception\UnprocessableEntityHttpException;

/**
 * Class PatientAdmissionRepository
 * @version February 27, 2020, 12:09 pm UTC
 */
class PatientAdmissionRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'patient_id',
        'admission_date',
        'discharge_date',
        'package_id',
        'insurance_id',
        'policy_no',
        'agent_name',
        'guardian_name',
        'guardian_relation',
        'guardian_contact',
        'guardian_address',
        'status',
    ];

    /**
     * Return searchable fields
     *
     * @return array
     */
    public function getFieldsSearchable()
    {
        return $this->fieldSearchable;
    }

    /**
     * Configure the Model
     **/
    public function model()
    {
        return PatientAdmission::class;
    }

    /**
     * @param  null  $patientAdmission
     *
     * @return mixed
     */
    public function getSyncList($patientAdmission = null)
    {
        /** @var PatientRepository $patientRepository */
        $patientRepository = app(PatientRepository::class);
        $data['patients'] = $patientRepository->getPatients();

        /** @var DoctorRepository $doctorRepository */
        $doctorRepository = app(DoctorRepository::class);
        $data['doctors'] = $doctorRepository->getDoctors();

        $data['packages'] = Package::orderBy('name')->pluck('name', 'id')->toArray();
        $data['insurances'] = Insurance::whereStatus(1)->orderBy('name')->pluck('name', 'id')->toArray();
        if (isset($patientAdmission)) {
            $data['beds'] = Bed::where('is_available', 1)->orWhere('id',
                $patientAdmission->bed_id)->where('is_available',
                0)->pluck('name', 'id')->sort();
        } else {
            $data['beds'] = Bed::where('is_available', 1)->pluck('name', 'id')->sort();
        }

        return $data;
    }

    /**
     * @param  int  $bedId
     *
     * @return bool
     */
    public function setBedAvailable($bedId)
    {
        $bed = Bed::findOrFail($bedId);
        $bed->update(['is_available' => 1]);

        return true;
    }

    /**
     * @param  int  $bedId
     *
     * @return bool
     */
    public function setBedUnAvailable($bedId)
    {
        $bed = Bed::findOrFail($bedId);
        $bed->update(['is_available' => 0]);

        return true;
    }

    /**
     * @param $input
     *
     * @return bool|UnprocessableEntityHttpException
     */
    public function store($input)
    {
        try {
            $input['guardian_contact'] = preparePhoneNumber($input, 'guardian_contact');
            $input['patient_admission_id'] = mb_strtoupper(PatientAdmission::generateUniquePatientId());
            $input['package_id'] = (! empty($input['package_id'])) ? $input['package_id'] : null;
            $input['insurance_id'] = (! empty($input['insurance_id'])) ? $input['insurance_id'] : null;
            $input['bed_id'] = (! empty($input['bed_id'])) ? $input['bed_id'] : null;
            PatientAdmission::create($input);
            if (isset($input['bed_id'])) {
                self::setBedUnAvailable($input['bed_id']);
            }

            return true;
        } catch (\Exception $e) {
            return new UnprocessableEntityHttpException($e->getMessage());
        }
    }

    /**
     * @param  array  $input
     * @param  PatientAdmission  $patientAdmission
     *
     * @return bool
     */
    public function update($input, $patientAdmission)
    {
        try {
            unset($input['patient_id']);
            $input['guardian_contact'] = preparePhoneNumber($input, 'guardian_contact');
            $bedId = $patientAdmission->bed_id;
            $disChargeDate = $patientAdmission->discharge_date;
            $input['package_id'] = (! empty($input['package_id'])) ? $input['package_id'] : null;
            $input['insurance_id'] = (! empty($input['insurance_id'])) ? $input['insurance_id'] : null;
            $input['bed_id'] = (! empty($input['bed_id'])) ? $input['bed_id'] : null;
            $input['discharge_date'] = (! empty($input['discharge_date'])) ? $input['discharge_date'] : null;
            $patientAdmission->update($input);

            if (isset($bedId)) {
                self::setBedAvailable($bedId);
            }
            if (isset($input['bed_id'])) {
                self::setBedUnAvailable($input['bed_id']);
            }

            if (isset($input['bed_id']) && (isset($input['discharge_date']))) {
                self::setBedAvailable($input['bed_id']); // make bed available
            }

            return true;
        } catch (Exception $e) {
            throw new UnprocessableEntityHttpException($e->getMessage());
        }
    }
}
