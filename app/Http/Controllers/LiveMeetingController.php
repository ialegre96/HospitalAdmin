<?php

namespace App\Http\Controllers;

use App;
use App\Http\Requests\LiveMeetingRequest;
use App\Models\LiveMeeting;
use App\Queries\LiveMeetingDataTable;
use App\Repositories\LiveMeetingRepository;
use App\Repositories\ZoomRepository;
use DataTables;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class LiveMeetingController extends AppBaseController
{
    /** @var LiveMeetingRepository */
    private $liveMeetingRepository;

    /**
     * LiveMeetingController constructor.
     * @param  LiveMeetingRepository  $liveMeetingRepository
     */
    public function __construct(LiveMeetingRepository $liveMeetingRepository)
    {
        $this->liveMeetingRepository = $liveMeetingRepository;
    }

    /**
     * @param  Request  $request
     *
     * @throws Exception
     *
     * @return Application|Factory|View
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            return Datatables::of((new LiveMeetingDataTable)->get($request->only(['status'])))->make(true);
        }
        $users = $this->liveMeetingRepository->getUsers();
        $status = LiveMeeting::status;

        return view('live_consultations.member_index', compact('users', 'status'));
    }

    /**
     * @param  LiveMeetingRequest  $request
     *
     * @return JsonResponse
     */
    public function liveMeetingStore(LiveMeetingRequest $request)
    {
        try {
            $this->liveMeetingRepository->store($request->all());
            $this->liveMeetingRepository->createNotification($request->all());

            return $this->sendSuccess('Live Meeting saved successfully.');
        } catch (Exception $e) {
            return $this->sendError($e->getMessage());
        }
    }

    /**
     * @param  Request  $request
     *
     * @return JsonResponse
     */
    public function getChangeStatus(Request $request)
    {
        $liveMeeting = LiveMeeting::findOrFail($request->get('id'));
        $status = null;

        if ($request->get('statusId') == LiveMeeting::STATUS_AWAITED) {
            $status = LiveMeeting::STATUS_AWAITED;
        } elseif ($request->get('statusId') == LiveMeeting::STATUS_CANCELLED) {
            $status = LiveMeeting::STATUS_CANCELLED;
        } else {
            $status = LiveMeeting::STATUS_FINISHED;
        }

        $liveMeeting->update([
            'status' => $status,
        ]);

        return $this->sendsuccess('Status changed successfully.');
    }

    /**
     * @param  LiveMeeting  $liveMeeting
     *
     * @return JsonResponse
     */
    public function getLiveStatus(LiveMeeting $liveMeeting)
    {
        $data['liveMeeting'] = LiveMeeting::with('user')->find($liveMeeting->id);

        /** @var ZoomRepository $zoomRepo */
        $zoomRepo = App::make(ZoomRepository::class, ['createdBy' => $liveMeeting->created_by]);
        $data['zoomLiveData'] = $zoomRepo->get($liveMeeting->meta['id'], ['meeting_owner' => $liveMeeting->created_by]);

        return $this->sendResponse($data, 'Live Status retrieved successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  LiveMeeting  $liveMeeting
     *
     * @return JsonResponse
     */
    public function edit(LiveMeeting $liveMeeting)
    {
        $liveMeeting->load('members');
        $meetingUsers = $liveMeeting->members->pluck('id')->toArray();
        $liveMeeting->setAttribute('meetingUsers', $meetingUsers);

        return $this->sendResponse($liveMeeting, 'Live Meeting retrieved successfully.');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  LiveMeetingRequest  $request
     *
     * @param  LiveMeeting  $liveMeeting
     *
     * @return JsonResponse
     */
    public function update(LiveMeetingRequest $request, LiveMeeting $liveMeeting)
    {
        try {
            $this->liveMeetingRepository->edit($request->all(), $liveMeeting);

            return $this->sendSuccess('Live Meeting updated successfully.');
        } catch (Exception $e) {
            return $this->sendError($e->getMessage());
        }
    }

    /**
     * @param  LiveMeeting  $liveMeeting
     *
     * @return JsonResponse
     */
    public function show(LiveMeeting $liveMeeting)
    {
        $liveMeeting = LiveMeeting::with(['user'])->find($liveMeeting->id);

        return $this->sendResponse($liveMeeting, 'Live Meeting retrieved successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  LiveMeeting  $liveMeeting
     *
     * @return JsonResponse
     */
    public function destroy(LiveMeeting $liveMeeting)
    {
        try {
            $liveMeeting->delete();

            return $this->sendSuccess('Live Meeting deleted successfully.');
        } catch (Exception $e) {
            return $this->sendError($e->getMessage());
        }
    }
}
