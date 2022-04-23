<?php

namespace App\Queries;

use App\Models\Document;
use App\Models\User;
use Auth;
use Illuminate\Database\Eloquent\Builder;

/**
 * Class DocumentDataTable
 */
class DocumentDataTable
{
    /**
     * @return Builder
     */
    public function get()
    {
        $query = Document::whereHas('patient.user')->with(['documentType', 'patient.user', 'media']);

        $user = getLoggedInUser();
        if ($user->hasRole('Patient')) {
            $query->where('patient_id', $user->owner_id);
        } elseif ($user->hasRole('Doctor')) {
            $query->where('uploaded_by', $user->id);
        }

        return $query->select('documents.*');
    }
}
