<?php

namespace App\Http\Controllers\Patient;

use App\Http\Controllers\Controller;
use App\Models\OpdPatientDepartment;
use App\Queries\VaccinatedPatientDataTable;
use App\Repositories\OpdPatientDepartmentRepository;
use DataTables;
use Exception;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use Illuminate\View\View;

class VaccinatedController extends Controller
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
            return Datatables::of((new VaccinatedPatientDataTable())->get())->make(true);
        }

        return view('patient_vaccinated_list.index');
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
