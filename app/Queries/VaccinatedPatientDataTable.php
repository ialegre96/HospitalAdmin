<?php

namespace App\Queries;

use App\Models\User;
use App\Models\VaccinatedPatients;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;

/**
 * Class VaccinationDataTable
 */
class VaccinatedPatientDataTable
{
    /**
     * @return Builder
     */
    public function get()
    {
        $query = VaccinatedPatients::whereHas('patient.user')->with(['patient.user.media', 'vaccination']);

        /** @var User $user */
        $user = Auth::user();
        if ($user->hasRole('Patient')) {
            $query->where('patient_id', $user->owner_id);
        }

        return $query->select('vaccinated_patients.*')->select('vaccinated_patients.*');
    }
}
