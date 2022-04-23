<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateDeathReportRequest;
use App\Http\Requests\UpdateDeathReportRequest;
use App\Models\DeathReport;
use App\Models\PatientCase;
use App\Queries\DeathReportDataTable;
use App\Repositories\DeathReportRepository;
use Carbon\Carbon;
use DataTables;
use Exception;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DeathReportController extends AppBaseController
{
    /** @var DeathReportRepository */
    private $deathReportRepository;

    public function __construct(DeathReportRepository $deathReportRepo)
    {
        $this->middleware('check_menu_access');
        $this->deathReportRepository = $deathReportRepo;
    }

    /**
     * Display a listing of the DeathReport.
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
            return Datatables::of((new DeathReportDataTable())->get())->addColumn('patientImageUrl',
                function (DeathReport $deathReport) {
                    return $deathReport->patient->user->image_url;
                })->addColumn('doctorImageUrl', function (DeathReport $deathReport) {
                return $deathReport->doctor->user->image_url;
            })->make(true);
        }
        $cases = $this->deathReportRepository->getCases();
        $doctors = $this->deathReportRepository->getDoctors();

        return view('death_reports.index', compact('cases', 'doctors'));
    }

    /**
     * Store a newly created DeathReport in storage.
     *
     * @param  CreateDeathReportRequest  $request
     *
     * @return JsonResponse
     */
    public function store(CreateDeathReportRequest $request)
    {
        $input = $request->all();
        $input['date'] = Carbon::parse($input['date'])->format('Y-m-d H:i:s');
        $patientId = PatientCase::with('patient.user')->whereCaseId($input['case_id'])->first();
        $birthDate = $patientId->patient->user->dob;
        $deathDate = Carbon::parse($input['date'])->toDateString();
        if (! empty($birthDate) && $deathDate < $birthDate) {
            return $this->sendError('Date should not be smaller than patient birth date.');
        }
        $deathReport = $this->deathReportRepository->store($input);

        return $this->sendSuccess('Death Report saved successfully.');
    }

    /**
     * Display the specified DeathReport.
     *
     * @param  DeathReport  $deathReport
     *
     * @return Factory|View
     */
    public function show(DeathReport $deathReport)
    {
        $cases = $this->deathReportRepository->getCases();
        $doctors = $this->deathReportRepository->getDoctors();

        return view('death_reports.show')->with([
            'deathReport' => $deathReport, 'cases' => $cases, 'doctors' => $doctors,
        ]);
    }

    /**
     * Show the form for editing the specified DeathReport.
     *
     * @param  DeathReport  $deathReport
     *
     * @return JsonResponse
     */
    public function edit(DeathReport $deathReport)
    {
        return $this->sendResponse($deathReport, 'Death Report retrieved successfully.');
    }

    /**
     * Update the specified DeathReport in storage.
     *
     * @param  DeathReport  $deathReport
     * @param  UpdateDeathReportRequest  $request
     *
     * @return JsonResponse
     */
    public function update(DeathReport $deathReport, UpdateDeathReportRequest $request)
    {
        $input = $request->all();
        $patientId = PatientCase::with('patient.user')->whereCaseId($input['case_id'])->first();
        $birthDate = $patientId->patient->user->dob;
        $deathDate = Carbon::parse($input['date'])->toDateString();
        if (! empty($birthDate) && $deathDate < $birthDate) {
            return $this->sendError('Date should not be smaller than patient birth date.');
        }

        $deathReport = $this->deathReportRepository->update($request->all(), $deathReport);

        return $this->sendSuccess('Death Report updated successfully.');
    }

    /**
     * Remove the specified DeathReport from storage.
     *
     * @param  DeathReport  $deathReport
     *
     * @throws Exception
     *
     * @return JsonResponse
     */
    public function destroy(DeathReport $deathReport)
    {
        $this->deathReportRepository->delete($deathReport->id);

        return $this->sendSuccess('Death Report deleted successfully.');
    }
}
