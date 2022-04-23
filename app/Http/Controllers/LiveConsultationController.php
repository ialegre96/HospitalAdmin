<?php

namespace App\Http\Controllers;

use App;
use App\Http\Requests\CreateZoomCredentialRequest;
use App\Http\Requests\LiveConsultationRequest;
use App\Models\LiveConsultation;
use App\Models\UserZoomCredential;
use App\Queries\LiveConsultationDataTable;
use App\Repositories\LiveConsultationRepository;
use App\Repositories\PatientCaseRepository;
use App\Repositories\ZoomRepository;
use DataTables;
use Exception;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * Class LiveConsultationController
 */
class LiveConsultationController extends AppBaseController
{
    /** @var LiveConsultationRepository */
    private $liveConsultationRepository;
    /** @var PatientCaseRepository */
    private $patientCaseRepository;

    /**
     * LiveConsultationController constructor.
     * @param  LiveConsultationRepository  $liveConsultationRepository
     * @param  PatientCaseRepository  $patientCaseRepository
     */
    public function __construct(
        LiveConsultationRepository $liveConsultationRepository,
        PatientCaseRepository $patientCaseRepository
    ) {
        $this->liveConsultationRepository = $liveConsultationRepository;
        $this->patientCaseRepository = $patientCaseRepository;
    }

    /**
     * Display a listing of the LabTechnician.
     *
     * @param  Request  $request
     *
     * @throws Exception
     *
     * @return Factory|View
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            return Datatables::of((new LiveConsultationDataTable())->get($request->only(['status'])))->make(true);
        }
        $doctors = $this->patientCaseRepository->getDoctors();
        $patients = $this->patientCaseRepository->getPatients();
        $type = LiveConsultation::STATUS_TYPE;
        $status = LiveConsultation::status;

        return view('live_consultations.index', compact('doctors', 'patients', 'type', 'status'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  LiveConsultationRequest  $request
     *
     * @return JsonResponse
     */
    public function store(LiveConsultationRequest $request)
    {
        try {
            $this->liveConsultationRepository->store($request->all());
            $this->liveConsultationRepository->createNotification($request->all());

            return $this->sendSuccess('Live Consultation saved successfully.');
        } catch (Exception $e) {
            return $this->sendError($e->getMessage());
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  LiveConsultation  $liveConsultation
     *
     * @return JsonResponse
     */
    public function edit(LiveConsultation $liveConsultation)
    {
        return $this->sendResponse($liveConsultation, 'Live Consultation retrieved successfully.');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  LiveConsultationRequest  $request
     *
     * @param  LiveConsultation  $liveConsultation
     *
     * @return JsonResponse
     */
    public function update(LiveConsultationRequest $request, LiveConsultation $liveConsultation)
    {
        try {
            $this->liveConsultationRepository->edit($request->all(), $liveConsultation);

            return $this->sendSuccess('Live Consultation updated successfully.');
        } catch (Exception $e) {
            return $this->sendError($e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  LiveConsultation  $liveConsultation
     *
     * @return JsonResponse
     */
    public function destroy(LiveConsultation $liveConsultation)
    {
        try {
            $liveConsultation->delete();

            return $this->sendSuccess('Live Consultation deleted successfully.');
        } catch (Exception $e) {
            return $this->sendError($e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  Request  $request
     *
     * @return JsonResponse
     */
    public function getTypeNumber(Request $request)
    {
        try {
            $typeNumber = $this->liveConsultationRepository->getTypeNumber($request->all());

            return $this->sendResponse($typeNumber, 'Type Number Retrieved successfully.');
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
        $liveConsultation = LiveConsultation::findOrFail($request->get('id'));
        $status = null;

        if ($request->get('statusId') == LiveConsultation::STATUS_AWAITED) {
            $status = LiveConsultation::STATUS_AWAITED;
        } elseif ($request->get('statusId') == LiveConsultation::STATUS_CANCELLED) {
            $status = LiveConsultation::STATUS_CANCELLED;
        } else {
            $status = LiveConsultation::STATUS_FINISHED;
        }

        $liveConsultation->update([
            'status' => $status,
        ]);

        return $this->sendsuccess('Status changed successfully.');
    }

    /**
     * @param  LiveConsultation  $liveConsultation
     *
     * @return JsonResponse
     */
    public function getLiveStatus(LiveConsultation $liveConsultation)
    {
        $data['liveConsultation'] = LiveConsultation::with('user')->find($liveConsultation->id);
        /** @var ZoomRepository $zoomRepo */
        $zoomRepo = App::make(ZoomRepository::class, ['createdBy' => $liveConsultation->created_by]);

        $data['zoomLiveData'] = $zoomRepo->get($liveConsultation->meeting_id,
            ['meeting_owner' => $liveConsultation->created_by]);

        return $this->sendResponse($data, 'Live Status retrieved successfully.');
    }

    /**
     * @param  LiveConsultation  $liveConsultation
     *
     * @return JsonResponse
     */
    public function show(LiveConsultation $liveConsultation)
    {
        $data['liveConsultation'] = LiveConsultation::with([
            'user', 'patient.user', 'doctor.user', 'opdPatient', 'ipdPatient',
        ])->find($liveConsultation->id);
        $data['typeNumber'] = ($liveConsultation->type == LiveConsultation::OPD) ? $liveConsultation->opdPatient->opd_number : $liveConsultation->ipdPatient->ipd_number;

        return $this->sendResponse($data, 'Live Consultation retrieved successfully.');
    }

    /**
     * @param  int  $id
     *
     * @return JsonResponse
     */
    public function zoomCredential($id)
    {
        try {
            $data = UserZoomCredential::where('user_id', $id)->first();

            return $this->sendResponse($data, 'User Zoom Credential retrieved successfully.');
        } catch (Exception $e) {
            return $this->sendError($e->getMessage());
        }
    }

    /**
     * @param  CreateZoomCredentialRequest  $request
     *
     * @return JsonResponse
     */
    public function zoomCredentialCreate(CreateZoomCredentialRequest $request)
    {
        try {
            $this->liveConsultationRepository->createUserZoom($request->all());

            return $this->sendSuccess('User Zoom Credential saved successfully.');
        } catch (Exception $e) {
            return $this->sendError($e->getMessage());
        }
    }
}
