<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\AppBaseController;
use App\Models\PatientAdmission;
use App\Queries\PatientAdmissionDataTable;
use DataTables;
use Exception;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PatientAdmissionController extends AppBaseController
{
    /**
     * Display a listing of the PatientAdmission.
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
            return Datatables::of((new PatientAdmissionDataTable())->get($request->only(['status'])))
                ->addColumn('patientImageUrl', function (PatientAdmission $patientAdmission) {
                    return $patientAdmission->patient->user->image_url;
                })->addColumn('doctorImageUrl', function (PatientAdmission $patientAdmission) {
                    return $patientAdmission->doctor->user->image_url;
                })->make(true);
        }
        $data['statusArr'] = PatientAdmission::STATUS_ARR;

        return view('employees.patient_admissions.index', $data);
    }

    /**
     * Display the specified PatientAdmission.
     *
     * @param  PatientAdmission  $patientAdmission
     *
     * @return Factory|View
     */
    public function show(PatientAdmission $patientAdmission)
    {
        return view('employees.patient_admissions.show')->with('patientAdmission', $patientAdmission);
    }
}
