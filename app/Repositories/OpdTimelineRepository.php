<?php

namespace App\Repositories;

use App\Models\OpdTimeline;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpKernel\Exception\UnprocessableEntityHttpException;

/**
 * Class OpdTimelineRepository
 * @version September 16, 2020, 7:18 am UTC
 */
class OpdTimelineRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'opd_patient_department_id',
        'title',
        'date',
        'description',
        'visible_to_person',
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
        return OpdTimeline::class;
    }

    /**
     * @param $opdPatientDepartmentId
     *
     *
     * @return \Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection
     */
    public function getTimeLines($opdPatientDepartmentId)
    {
        if (Auth::user()->hasRole('Admin')) {
            return OpdTimeline::where('opd_patient_department_id', $opdPatientDepartmentId)->get();
        }

        return OpdTimeline::where('opd_patient_department_id', $opdPatientDepartmentId)->visible()->get();
    }

    /**
     * @param  array  $input
     */
    public function store($input)
    {
        try {
            /** @var OpdTimeline $opdTimeline */
            $input['visible_to_person'] = isset($input['visible_to_person']) ? 1 : 0;
            $opdTimeline = $this->create($input);
            if (isset($input['attachment']) && ! empty($input['attachment'])) {
                $opdTimeline->addMedia($input['attachment'])->toMediaCollection(OpdTimeline::OPD_TIMELINE_PATH,
                    config('app.media_disc'));
            }
        } catch (\Exception $e) {
            throw new UnprocessableEntityHttpException($e->getMessage());
        }
    }

    /**
     * @param  array  $input
     * @param  int  $opdTimelineId
     */
    public function updateOpdTimeline($input, $opdTimelineId)
    {
        try {
            /** @var OpdTimeline $opdTimeline */
            $input['visible_to_person'] = isset($input['visible_to_person']) ? 1 : 0;
            $opdTimeline = $this->update($input, $opdTimelineId);
            if (isset($input['attachment']) && !empty($input['attachment'])) {
                if ($opdTimeline->media->first() != null) {
                    $opdTimeline->deleteMedia($opdTimeline->media->first()->id);
                }
                $opdTimeline->addMedia($input['attachment'])->toMediaCollection(OpdTimeline::OPD_TIMELINE_PATH,
                    config('app.media_disc'));
            }
            if ($input['avatar_remove'] == 1 && isset($input['avatar_remove']) && !empty($input['avatar_remove'])) {
                removeFile($opdTimeline, OpdTimeline::OPD_TIMELINE_PATH);
            }
        } catch (\Exception $e) {
            throw new UnprocessableEntityHttpException($e->getMessage());
        }
    }

    /**
     * @param  int  $opdTimelineId
     */
    public function deleteOpdTimeline($opdTimelineId)
    {
        try {
            /** @var OpdTimeline $opdTimeline */
            $opdTimeline = $this->find($opdTimelineId);
            $opdTimeline->clearMediaCollection(OpdTimeline::OPD_TIMELINE_PATH);
            $this->delete($opdTimelineId);
        } catch (\Exception $e) {
            throw new UnprocessableEntityHttpException($e->getMessage());
        }
    }
}
