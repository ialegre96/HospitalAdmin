<?php

namespace App\Http\Controllers\Patient;

use App\Http\Controllers\Controller;
use App\Models\IpdPatientDepartment;
use App\Models\OpdPatientDepartment;
use App\Models\User;
use App\Queries\Patients\IpdPatientDepartmentDataTable;
use App\Queries\Patients\OpdPatientDepartmentDataTable;
use App\Repositories\OpdPatientDepartmentRepository;
use DataTables;
use Exception;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use Illuminate\View\View;

class OpdPatientDepartmentController extends Controller
{
    /** @var OpdPatientDepartmentRepository */
    private $opdPatientDepartmentRepository;

    public function __construct(OpdPatientDepartmentRepository $opdPatientDepartmentRepo)
    {
        $this->opdPatientDepartmentRepository = $opdPatientDepartmentRepo;
    }

    /**
     * Display a listing of the resource.
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
            return Datatables::of((new OpdPatientDepartmentDataTable())
                ->get($request->only(['status'])))
                ->addColumn(User::IMG_COLUMN,
                    function (OpdPatientDepartment $opdPatientDepartment) {
                        return $opdPatientDepartment->patient->user->image_url;
                    })->addColumn('doctorImageUrl', function (OpdPatientDepartment $opdPatientDepartment) {
                    return $opdPatientDepartment->doctor->user->image_url;
                })->make(true);
        }

        return view('opd_patient_list.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  OpdPatientDepartment  $opdPatientDepartment
     *
     * @return Factory|View
     */
    public function show(OpdPatientDepartment $opdPatientDepartment)
    {
        return view('opd_patient_list.show', compact('opdPatientDepartment'));
    }
}
