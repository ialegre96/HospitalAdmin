<?php

namespace App\Repositories;

use App\Models\IpdTimeline;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpKernel\Exception\UnprocessableEntityHttpException;

/**
 * Class IpdTimelineRepository
 * @version September 12, 2020, 7:18 am UTC
 */
class IpdTimelineRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'ipd_patient_department_id',
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
        return IpdTimeline::class;
    }

    public function getTimeLines($ipdPatientDepartmentId)
    {
        if (Auth::user()->hasRole('Admin')) {
            return IpdTimeline::where('ipd_patient_department_id', $ipdPatientDepartmentId)->get();
        }

        return IpdTimeline::where('ipd_patient_department_id', $ipdPatientDepartmentId)->visible()->get();
    }

    /**
     * @param  array  $input
     */
    public function store($input)
    {
        try {
            /** @var IpdTimeline $ipdTimeline */
            $input['visible_to_person'] = isset($input['visible_to_person']) ? 1 : 0;
            $ipdTimeline = $this->create($input);
            if (isset($input['attachment']) && ! empty($input['attachment'])) {
                $ipdTimeline->addMedia($input['attachment'])->toMediaCollection(IpdTimeline::IPD_TIMELINE_PATH,
                    config('app.media_disc'));
            }
        } catch (\Exception $e) {
            throw new UnprocessableEntityHttpException($e->getMessage());
        }
    }

    /**
     * @param  array  $input
     * @param  int  $ipdTimelineId
     */
    public function updateIpdTimeline($input, $ipdTimelineId)
    {
        try {
            /** @var IpdTimeline $ipdTimeline */
            $input['visible_to_person'] = isset($input['visible_to_person']) ? 1 : 0;
            $ipdTimeline = $this->update($input, $ipdTimelineId);
            if (isset($input['attachment']) && !empty($input['attachment'])) {
                if ($ipdTimeline->media->first() != null) {
                    $ipdTimeline->deleteMedia($ipdTimeline->media->first()->id);
                }
                $ipdTimeline->addMedia($input['attachment'])->toMediaCollection(IpdTimeline::IPD_TIMELINE_PATH,
                    config('app.media_disc'));
            }
            if ($input['avatar_remove'] == 1 && isset($input['avatar_remove']) && !empty($input['avatar_remove'])) {
                removeFile($ipdTimeline, IpdTimeline::IPD_TIMELINE_PATH);
            }
        } catch (\Exception $e) {
            throw new UnprocessableEntityHttpException($e->getMessage());
        }
    }

    /**
     * @param  int  $ipdTimelineId
     */
    public function deleteIpdTimeline($ipdTimelineId)
    {
        try {
            /** @var IpdTimeline $ipdTimeline */
            $ipdTimeline = $this->find($ipdTimelineId);
            if ($ipdTimeline->media->first() != null) {
                $ipdTimeline->deleteMedia($ipdTimeline->media->first()->id);
            }
            $this->delete($ipdTimelineId);
        } catch (\Exception $e) {
            throw new UnprocessableEntityHttpException($e->getMessage());
        }
    }
}
