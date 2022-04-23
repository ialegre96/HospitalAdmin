<?php

namespace App\Repositories;

use App\Models\Patient;
use App\Models\VaccinatedPatients;
use App\Models\Vaccination;
use Illuminate\Support\Facades\Auth;

/**
 * Class VaccinatedPatientRepository
 * @version March 31, 2020, 12:22 pm UTC
 */
class VaccinatedPatientRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'patient_id',
        'vaccination_id',
        'vaccination_serial_number',
        'dose_type',
        'dose_given_date',
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
        return VaccinatedPatients::class;
    }

    /**
     * @return array
     */
    public function getVaccinatedPatientData()
    {
        $data = null;

        $user = Auth::user();
        if ($user->hasRole('Doctor')) {
            $data['patients'] = getPatientsList($user->owner_id);
        } else {
//            $data['patients'] = Patient::with('user')->whereHas('user', function (Builder $query) {
//                $query->where('status', 1);
//            })->get()->pluck('user.full_name', 'id');
            $data['patients'] = Patient::getActivePatientNames();
        }

        $data['vaccinations'] = Vaccination::toBase()->pluck('name', 'id')->toArray();
        natcasesort($data['vaccinations']);

        return $data;
    }
}
