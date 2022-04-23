<?php

namespace App\Http\Controllers;

use App\Exports\LabTechnicianExport;
use App\Http\Requests\CreateLabTechnicianRequest;
use App\Http\Requests\UpdateLabTechnicianRequest;
use App\Models\EmployeePayroll;
use App\Models\LabTechnician;
use App\Models\User;
use App\Queries\LabTechnicianDataTable;
use App\Repositories\LabTechnicianRepository;
use DataTables;
use Exception;
use Flash;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\View\View;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class LabTechnicianController extends AppBaseController
{
    /** @var LabTechnicianRepository */
    private $labTechnicianRepository;

    public function __construct(LabTechnicianRepository $labTechnicianRepo)
    {
        $this->labTechnicianRepository = $labTechnicianRepo;
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
            return Datatables::of((new LabTechnicianDataTable())->get($request->only(['status'])))
                ->addColumn(User::IMG_COLUMN, function (LabTechnician $labTechnician) {
                    return $labTechnician->user->image_url;
                })->make(true);
        }
        $data['statusArr'] = LabTechnician::STATUS_ARR;

        return view('lab_technicians.index', $data);
    }

    /**
     * Show the form for creating a new LabTechnician.
     *
     * @return Factory|View
     */
    public function create()
    {
        $bloodGroup = getBloodGroups();

        return view('lab_technicians.create', compact('bloodGroup'));
    }

    /**
     * Store a newly created LabTechnician in storage.
     *
     * @param  CreateLabTechnicianRequest  $request
     *
     * @return RedirectResponse|Redirector
     */
    public function store(CreateLabTechnicianRequest $request)
    {
        $input = $request->all();
        $input['status'] = isset($input['status']) ? 1 : 0;
        $labTechnician = $this->labTechnicianRepository->store($input);

        Flash::success('Lab Technician saved successfully.');

        return redirect(route('lab-technicians.index'));
    }

    /**
     * Display the specified LabTechnician.
     *
     * @param  int  $id
     *
     * @return Factory|View
     */
    public function show($id)
    {
        $labTechnician = LabTechnician::findOrFail($id);
        $payrolls = $labTechnician->payrolls;

        return view('lab_technicians.show', compact('labTechnician', 'payrolls'));
    }

    /**
     * Show the form for editing the specified LabTechnician.
     *
     * @param  int  $id
     *
     * @return Factory|View
     */
    public function edit($id)
    {
        $labTechnician = LabTechnician::findOrFail($id);
        $user = $labTechnician->user;
        $bloodGroup = getBloodGroups();

        return view('lab_technicians.edit', compact('labTechnician', 'user', 'bloodGroup'));
    }

    /**
     * Update the specified LabTechnician in storage.
     *
     * @param  LabTechnician  $labTechnician
     * @param  UpdateLabTechnicianRequest  $request
     *
     * @return RedirectResponse|Redirector
     */
    public function update(LabTechnician $labTechnician, UpdateLabTechnicianRequest $request)
    {
        $labTechnician = $this->labTechnicianRepository->update($labTechnician, $request->all());

        Flash::success('Lab Technician updated successfully.');

        return redirect(route('lab-technicians.index'));
    }

    /**
     * Remove the specified LabTechnician from storage.
     *
     * @param  LabTechnician  $labTechnician
     *
     * @throws Exception
     *
     * @return JsonResponse
     */
    public function destroy(LabTechnician $labTechnician)
    {
        $empPayRollResult = canDeletePayroll(EmployeePayroll::class, 'owner_id', $labTechnician->id);
        if ($empPayRollResult) {
            return $this->sendError('Lab Technician can\'t be deleted.');
        }
        $labTechnician->user()->delete();
        $labTechnician->address()->delete();
        $labTechnician->delete();

        return $this->sendSuccess('Lab Technician deleted Successfully.');
    }

    /**
     * @param  int  $id
     *
     * @return JsonResponse
     */
    public function activeDeactiveStatus($id)
    {
        $labTechnician = LabTechnician::findOrFail($id);
        $status = ! $labTechnician->user->status;
        $labTechnician->user()->update(['status' => $status]);

        return $this->sendSuccess('Status updated successfully.');
    }

    /**
     * @return BinaryFileResponse
     */
    public function labTechnicianExport()
    {
        return Excel::download(new LabTechnicianExport, 'lab-technicians-'.time().'.xlsx');
    }
}
