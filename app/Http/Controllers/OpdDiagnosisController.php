<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateOpdDiagnosisRequest;
use App\Http\Requests\UpdateOpdDiagnosisRequest;
use App\Models\OpdDiagnosis;
use App\Queries\OpdDiagnosisDataTable;
use App\Repositories\OpdDiagnosisRepository;
use DataTables;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Response;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class OpdDiagnosisController extends AppBaseController
{
    /** @var OpdDiagnosisRepository */
    private $opdDiagnosisRepository;

    public function __construct(OpdDiagnosisRepository $opdDiagnosisRepo)
    {
        $this->opdDiagnosisRepository = $opdDiagnosisRepo;
    }

    /**
     * Display a listing of the OpdDiagnosis.
     *
     * @param  Request  $request
     *
     * @throws Exception
     *
     * @return Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            return DataTables::of((new OpdDiagnosisDataTable())->get($request->id))->make(true);
        }
    }

    /**
     * Store a newly created OpdDiagnosis in storage.
     *
     * @param  CreateOpdDiagnosisRequest  $request
     *
     * @return JsonResponse
     */
    public function store(CreateOpdDiagnosisRequest $request)
    {
        $input = $request->all();
        $this->opdDiagnosisRepository->store($input);
        $this->opdDiagnosisRepository->createNotification($input);

        return $this->sendSuccess('OPD Diagnosis saved successfully.');
    }

    /**
     * Show the form for editing the specified Opd Diagnosis.
     *
     * @param  OpdDiagnosis  $opdDiagnosis
     *
     * @return JsonResponse
     */
    public function edit(OpdDiagnosis $opdDiagnosis)
    {
        return $this->sendResponse($opdDiagnosis, 'OPD Diagnosis retrieved successfully.');
    }

    /**
     * Update the specified Opd Diagnosis in storage.
     *
     * @param  OpdDiagnosis  $opdDiagnosis
     *
     * @param  UpdateOpdDiagnosisRequest  $request
     *
     * @return JsonResponse
     */
    public function update(OpdDiagnosis $opdDiagnosis, UpdateOpdDiagnosisRequest $request)
    {
        $this->opdDiagnosisRepository->updateOpdDiagnosis($request->all(), $opdDiagnosis->id);

        return $this->sendSuccess('OPD Diagnosis updated successfully.');
    }

    /**
     * Remove the specified OpdDiagnosis from storage.
     *
     * @param  OpdDiagnosis  $opdDiagnosis
     *
     * @throws Exception
     *
     * @return JsonResponse
     */
    public function destroy(OpdDiagnosis $opdDiagnosis)
    {
        $this->opdDiagnosisRepository->deleteOpdDiagnosis($opdDiagnosis->id);

        return $this->sendSuccess('OPD Diagnosis deleted successfully.');
    }

    /**
     * @param  OpdDiagnosis  $opdDiagnosis
     *
     *
     * @return Media
     */
    public function downloadMedia(OpdDiagnosis $opdDiagnosis)
    {
        $media = $opdDiagnosis->getMedia(OpdDiagnosis::OPD_DIAGNOSIS_PATH)->first();
        if ($media) {
            return $media;
        }

        return '';
    }
}
