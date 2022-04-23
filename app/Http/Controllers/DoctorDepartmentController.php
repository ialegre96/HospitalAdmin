<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateDoctorDepartmentRequest;
use App\Http\Requests\UpdateDoctorDepartmentRequest;
use App\Models\Doctor;
use App\Models\DoctorDepartment;
use App\Queries\DoctorDepartmentDataTable;
use App\Repositories\DoctorDepartmentRepository;
use DataTables;
use Exception;
use Flash;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\View\View;

class DoctorDepartmentController extends AppBaseController
{
    /** @var DoctorDepartmentRepository */
    private $doctorDepartmentRepository;

    public function __construct(DoctorDepartmentRepository $doctorDepartmentRepo)
    {
        $this->doctorDepartmentRepository = $doctorDepartmentRepo;
    }

    /**
     * Display a listing of the DoctorDepartment.
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
            return Datatables::of((new DoctorDepartmentDataTable())->get())->make(true);
        }

        return view('doctor_departments.index');
    }

    /**
     * Store a newly created DoctorDepartment in storage.
     *
     * @param  CreateDoctorDepartmentRequest  $request
     *
     * @return JsonResponse
     */
    public function store(CreateDoctorDepartmentRequest $request)
    {
        $input = $request->all();
        $this->doctorDepartmentRepository->create($input);

        return $this->sendSuccess('Doctor Department saved successfully.');
    }

    /**
     * @param  DoctorDepartment  $doctorDepartment
     *
     * @return Factory|RedirectResponse|Redirector|View
     */
    public function show($id)
    {
        $doctorDepartment = DoctorDepartment::find($id);
        if (empty($doctorDepartment)) {
            Flash::error('Doctor Department not found');

            return redirect(route('doctor-departments.index'));
        }
        $doctors = $doctorDepartment->doctors;

        $doctorDepartment = $this->doctorDepartmentRepository->find($doctorDepartment->id);

        return view('doctor_departments.show', compact('doctors', 'doctorDepartment'));
    }

    /**
     * Show the form for editing the specified DoctorDepartment.
     *
     * @param  DoctorDepartment  $doctorDepartment
     *
     * @return JsonResponse
     */
    public function edit(DoctorDepartment $doctorDepartment)
    {
        return $this->sendResponse($doctorDepartment, 'Doctor Department retrieved successfully.');
    }

    /**
     * Update the specified DoctorDepartment in storage.
     *
     * @param  DoctorDepartment  $doctorDepartment
     * @param  UpdateDoctorDepartmentRequest  $request
     *
     * @return JsonResponse
     */
    public function update(DoctorDepartment $doctorDepartment, UpdateDoctorDepartmentRequest $request)
    {
        $input = $request->all();
        $doctorDepartment->update($input);

        return $this->sendSuccess('Doctor Department updated successfully.');
    }

    /**
     * Remove the specified DoctorDepartment from storage.
     *
     * @param  DoctorDepartment  $doctorDepartment
     *
     * @throws Exception
     *
     * @return JsonResponse
     */
    public function destroy(DoctorDepartment $doctorDepartment)
    {
        $doctorDepartmentModels = [
            Doctor::class,
        ];
        $result = canDelete($doctorDepartmentModels, 'doctor_department_id', $doctorDepartment->id);
        if ($result) {
            return $this->sendError('Doctor Department can\'t be deleted.');
        }
        $doctorDepartment->delete();

        return $this->sendSuccess('Doctor Department deleted successfully.');
    }
}
