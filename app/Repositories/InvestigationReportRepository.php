<?php

namespace App\Repositories;

use App\Models\Doctor;
use App\Models\InvestigationReport;
use App\Models\Patient;
use Auth;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;
use Symfony\Component\HttpKernel\Exception\UnprocessableEntityHttpException;

/**
 * Class InvestigationReportRepository
 * @version February 21, 2020, 9:02 am UTC
 */
class InvestigationReportRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'patient_id',
        'date',
        'title',
        'description',
        'doctor_id',
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
        return InvestigationReport::class;
    }

    /**
     * @return Collection
     */
    public function getPatients()
    {
        $user = Auth::user();
        if ($user->hasRole('Doctor')) {
            $patients = getPatientsList($user->owner_id);
        } else {
            $patients = Patient::with('user')
                ->whereHas('user', function (Builder $query) {
                    $query->where('status', 1);
                })->get()->pluck('user.full_name', 'id')->sort();
        }

        return $patients;
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

    /**
     * @param  array  $input
     *
     * @return bool
     */
    public function store($input)
    {
        try {
            /** @var InvestigationReport $report */
            $report = InvestigationReport::create($input);

            if (! empty($input['attachment'])) {
                $report->addMedia($input['attachment'])->toMediaCollection(InvestigationReport::COLLECTION_REPORTS,
                    config('app.media_disc'));
            }

            return true;
        } catch (\Exception $e) {
            throw new UnprocessableEntityHttpException($e->getMessage());
        }
    }

    /**
     * @param  array  $input
     * @param  int  $id
     *
     * @return bool
     */
    public function update($input, $id)
    {
        /** @var InvestigationReport $report */
        $report = InvestigationReport::findOrFail($id);
        try {
            $report->update($input);

            if (!empty($input['attachment'])) {
                $report->clearMediaCollection(InvestigationReport::COLLECTION_REPORTS);
                $report->addMedia($input['attachment'])->toMediaCollection(InvestigationReport::COLLECTION_REPORTS,
                    config('app.media_disc'));
            }
            if ($input['avatar_remove'] == 1 && isset($input['avatar_remove']) && !empty($input['avatar_remove'])) {
                removeFile($report, InvestigationReport::COLLECTION_REPORTS);
            }

            return true;
        } catch (\Exception $e) {
            throw new UnprocessableEntityHttpException($e->getMessage());
        }
    }
}
