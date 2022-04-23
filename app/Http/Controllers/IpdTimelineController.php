<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateIpdTimelineRequest;
use App\Http\Requests\UpdateIpdTimelineRequest;
use App\Models\IpdTimeline;
use App\Repositories\IpdTimelineRepository;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Throwable;

class IpdTimelineController extends AppBaseController
{
    /** @var IpdTimelineRepository */
    private $ipdTimelineRepository;

    public function __construct(IpdTimelineRepository $ipdTimelineRepo)
    {
        $this->ipdTimelineRepository = $ipdTimelineRepo;
    }

    /**
     * Display a listing of the IpdTimeline.
     *
     * @param  Request  $request
     *
     * @throws Throwable
     *
     * @return array|string
     */
    public function index(Request $request)
    {
        $ipdTimelines = $this->ipdTimelineRepository->getTimeLines($request->get('id'));

        return view('ipd_timelines.index', compact('ipdTimelines'))->render();
    }

    /**
     * Store a newly created IpdTimeline in storage.
     *
     * @param  CreateIpdTimelineRequest  $request
     *
     * @return JsonResponse
     */
    public function store(CreateIpdTimelineRequest $request)
    {
        $input = $request->all();
        $this->ipdTimelineRepository->store($input);

        return $this->sendSuccess('IPD Timeline saved successfully.');
    }

    /**
     * Show the form for editing the specified IpdTimeline.
     *
     * @param  IpdTimeline  $ipdTimeline
     *
     * @return JsonResponse
     */
    public function edit(IpdTimeline $ipdTimeline)
    {
        return $this->sendResponse($ipdTimeline, 'IPD Timeline retrieved successfully.');
    }

    /**
     * Update the specified IpdTimeline in storage.
     *
     * @param  IpdTimeline  $ipdTimeline
     * @param  UpdateIpdTimelineRequest  $request
     *
     * @return JsonResponse
     */
    public function update(IpdTimeline $ipdTimeline, UpdateIpdTimelineRequest $request)
    {
        $this->ipdTimelineRepository->updateIpdTimeline($request->all(), $ipdTimeline->id);

        return $this->sendSuccess('IPD Timeline updated successfully.');
    }

    /**
     * Remove the specified IpdTimeline from storage.
     *
     * @param  IpdTimeline  $ipdTimeline
     *
     * @throws Exception
     *
     * @return JsonResponse
     */
    public function destroy(IpdTimeline $ipdTimeline)
    {
        $this->ipdTimelineRepository->deleteIpdTimeline($ipdTimeline->id);

        return $this->sendSuccess('IPD Timeline deleted successfully.');
    }

    /**
     * @param  IpdTimeline  $ipdTimeline
     *
     * @return Media
     */
    public function downloadMedia(IpdTimeline $ipdTimeline)
    {
        $media = $ipdTimeline->getMedia(IpdTimeline::IPD_TIMELINE_PATH)->first();
        if ($media != null) {
            $media = $media->id;
            $mediaItem = Media::findOrFail($media);

            return $mediaItem;
        }

        return '';
    }
}
