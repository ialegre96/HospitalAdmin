<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateOperationReportRequest;
use App\Http\Requests\UpdateOperationReportRequest;
use App\Models\OperationReport;
use App\Models\PatientCase;
use App\Queries\OperationReportDataTable;
use App\Repositories\OperationReportRepository;
use Carbon\Carbon;
use DataTables;
use Exception;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\View\View;

class OperationReportController extends AppBaseController
{
    /** @var OperationReportRepository */
    private $operationReportRepository;

    public function __construct(OperationReportRepository $operationReportRepo)
    {
        $this->middleware('check_menu_access');
        $this->operationReportRepository = $operationReportRepo;
    }

    /**
     * Display a listing of the OperationReport.
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
            return Datatables::of((new OperationReportDataTable())->get())->addColumn('patientImageUrl',
                function (OperationReport $operationReport) {
                    return $operationReport->patient->user->image_url;
                })->addColumn('doctorImageUrl', function (OperationReport $operationReport) {
                return $operationReport->doctor->user->image_url;
            })->make(true);
        }
        $doctors = $this->operationReportRepository->getDoctors();
        $cases = $this->operationReportRepository->getCases();

        return view('operation_reports.index', compact('doctors', 'cases'));
    }

    /**
     * Store a newly created OperationReport in storage.
     *
     * @param  CreateOperationReportRequest  $request
     *
     * @return JsonResponse
     */
    public function store(CreateOperationReportRequest $request)
    {
        $input = $request->all();
        $patientId = PatientCase::with('patient.user')->whereCaseId($input['case_id'])->first();
        $birthDate = $patientId->patient->user->dob;
        $operationDate = Carbon::parse($input['date'])->toDateString();
        if (! empty($birthDate) && $operationDate < $birthDate) {
            return $this->sendError('Date should not be smaller than patient birth date.');
        }
        $this->operationReportRepository->store($input);

        return $this->sendSuccess('Operation Report saved successfully.');
    }

    /**
     * @param  OperationReport  $operationReport
     *
     * @return Factory|RedirectResponse|Redirector|View
     */
    public function show(OperationReport $operationReport)
    {
        $doctors = $this->operationReportRepository->getDoctors();
        $cases = $this->operationReportRepository->getCases();

        return view('operation_reports.show')->with([
            'operationReport' => $operationReport, 'doctors' => $doctors, 'cases' => $cases,
        ]);
    }

    /**
     * Show the form for editing the specified OperationReport.
     *
     * @param  OperationReport  $operationReport
     *
     * @return JsonResponse
     */
    public function edit(OperationReport $operationReport)
    {
        return $this->sendResponse($operationReport, 'Operation Report retrieved successfully.');
    }

    /**
     * Update the specified OperationReport in storage.
     *
     * @param  OperationReport  $operationReport
     * @param  UpdateOperationReportRequest  $request
     *
     * @return JsonResponse
     */
    public function update(OperationReport $operationReport, UpdateOperationReportRequest $request)
    {
        $input = $request->all();
        $patientId = PatientCase::with('patient.user')->whereCaseId($input['case_id'])->first();
        $birthDate = $patientId->patient->user->dob;
        $operationDate = Carbon::parse($input['date'])->toDateString();
        if (! empty($birthDate) && $operationDate < $birthDate) {
            return $this->sendError('Date should not be smaller than patient birth date.');
        }
        $this->operationReportRepository->update($input, $operationReport);

        return $this->sendSuccess('Operation Report updated successfully.');
    }

    /**
     * Remove the specified OperationReport from storage.
     *
     * @param  OperationReport  $operationReport
     *
     * @throws Exception
     *
     * @return JsonResponse
     */
    public function destroy(OperationReport $operationReport)
    {
        $operationReport->delete();

        return $this->sendSuccess('Operation Report deleted successfully.');
    }
}
