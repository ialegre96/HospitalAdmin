<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateBirthReportRequest;
use App\Http\Requests\UpdateBirthReportRequest;
use App\Models\BirthReport;
use App\Models\DeathReport;
use App\Models\PatientCase;
use App\Queries\BirthReportDataTable;
use App\Repositories\BirthReportRepository;
use Carbon\Carbon;
use DataTables;
use Exception;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\View\View;

class BirthReportController extends AppBaseController
{
    /** @var BirthReportRepository */
    private $birthReportRepository;

    public function __construct(BirthReportRepository $birthReportRepo)
    {
        $this->middleware('check_menu_access');
        $this->birthReportRepository = $birthReportRepo;
    }

    /**
     * Display a listing of the BirthReport.
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
            return Datatables::of((new BirthReportDataTable())->get())->addColumn('patientImageUrl',
                function (BirthReport $birthReport) {
                    return $birthReport->patient->user->image_url;
                })->addColumn('doctorImageUrl', function (BirthReport $birthReport) {
                return $birthReport->doctor->user->image_url;
            })->make(true);
        }
        $cases = $this->birthReportRepository->getCases();
        $doctors = $this->birthReportRepository->getDoctors();

        return view('birth_reports.index', compact('cases', 'doctors'));
    }

    /**
     * Store a newly created BirthReport in storage.
     *
     * @param  CreateBirthReportRequest  $request
     *
     * @return JsonResponse|Redirector
     */
    public function store(CreateBirthReportRequest $request)
    {
        $input = $request->all();
        $input['date'] = Carbon::parse($input['date'])->format('Y-m-d H:i:s');
        $patientId = PatientCase::with('patient.user')->whereCaseId($input['case_id'])->first();
        $birthDate = $patientId->patient->user->dob;
        $selectBirthDate = Carbon::parse($input['date'])->toDateString();
        if (! empty($birthDate) && $selectBirthDate < $birthDate) {
            return $this->sendError('Date should not be smaller than patient birth date.');
        }

        $isUserHasDead = DeathReport::whereCaseId($input['case_id'])->first();
        if (! empty($isUserHasDead)) {
            return $this->sendError('Can\'t create report because the patient has been dead.');
        }
        $birthReport = $this->birthReportRepository->store($input);

        return $this->sendSuccess('Birth Report saved successfully.');
    }

    /**
     * Display the specified BirthReport.
     *
     * @param  BirthReport  $birthReport
     *
     * @return Factory|View
     */
    public function show(BirthReport $birthReport)
    {
        $cases = $this->birthReportRepository->getCases();
        $doctors = $this->birthReportRepository->getDoctors();

        return view('birth_reports.show')->with([
            'birthReport' => $birthReport, 'cases' => $cases, 'doctors' => $doctors,
        ]);
    }

    /**
     * Show the form for editing the specified BirthReport.
     *
     * @param  BirthReport  $birthReport
     *
     * @return JsonResponse
     */
    public function edit(BirthReport $birthReport)
    {
        return $this->sendResponse($birthReport, 'Birth Report retrieved successfully.');
    }

    /**
     * Update the specified BirthReport in storage.
     *
     * @param  BirthReport  $birthReport
     * @param  UpdateBirthReportRequest  $request
     *
     * @return JsonResponse
     */
    public function update(BirthReport $birthReport, UpdateBirthReportRequest $request)
    {
        $input = $request->all();
        $patientId = PatientCase::with('patient.user')->whereCaseId($input['case_id'])->first();
        $birthDate = $patientId->patient->user->dob;
        $selectBirthDate = Carbon::parse($input['date'])->toDateString();
        if (! empty($birthDate) && $selectBirthDate < $birthDate) {
            return $this->sendError('Date should not be smaller than patient birth date.');
        }
        $birthReport = $this->birthReportRepository->update($request->all(), $birthReport);

        return $this->sendSuccess('Birth Report updated successfully.');
    }

    /**
     * Remove the specified BirthReport from storage.
     *
     * @param  BirthReport  $birthReport
     *
     * @throws Exception
     *
     * @return JsonResponse
     */
    public function destroy(BirthReport $birthReport)
    {
        $this->birthReportRepository->delete($birthReport->id);

        return $this->sendSuccess('Birth Report deleted successfully.');
    }
}
