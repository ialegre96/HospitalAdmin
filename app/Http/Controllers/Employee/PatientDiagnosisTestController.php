<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\AppBaseController;
use App\Models\IpdPatientDepartment;
use App\Models\PatientDiagnosisTest;
use App\Models\Prescription;
use App\Models\User;
use App\Queries\PatientDiagnosisTestDataTable;
use App\Queries\Patients\IpdPatientDepartmentDataTable;
use App\Queries\PrescriptionDataTable;
use App\Repositories\PatientDiagnosisTestRepository;
use Barryvdh\DomPDF\Facade as PDF;
use DataTables;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PatientDiagnosisTestController extends AppBaseController
{
    /**
     * @var PatientDiagnosisTestRepository
     */
    private $patientDiagnosisTestRepository;

    public function __construct(
        PatientDiagnosisTestRepository $patientDiagnosisTestRepository
    ) {
        $this->patientDiagnosisTestRepository = $patientDiagnosisTestRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @param  Request  $request
     *
     * @throws Exception
     *
     * @return Application|Factory|View
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
//            return DataTables::of((new PatientDiagnosisTestDataTable())
//                ->get())
//                ->make(true);

            return Datatables::of((new PatientDiagnosisTestDataTable())->get($request->only(['status'])))
                ->addColumn('patientImageUrl', function (PatientDiagnosisTest $patientDiagnosisTest) {
                    return $patientDiagnosisTest->patient->user->image_url;
                })->addColumn('doctorImageUrl', function (PatientDiagnosisTest $patientDiagnosisTest) {
                    return $patientDiagnosisTest->doctor->user->image_url;
                })->make(true);
        }

        return view('employees.patient_diagnosis_test.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  PatientDiagnosisTest  $patientDiagnosisTest
     *
     * @return Application|Factory|View
     */
    public function show(PatientDiagnosisTest $patientDiagnosisTest)
    {
        $patientDiagnosisTests = $this->patientDiagnosisTestRepository->getPatientDiagnosisTestProperty($patientDiagnosisTest->id);

        return view('employees.patient_diagnosis_test.show', compact('patientDiagnosisTests', 'patientDiagnosisTest'));
    }

    /**
     * @param  PatientDiagnosisTest  $patientDiagnosisTest
     */
    public function convertToPdf(PatientDiagnosisTest $patientDiagnosisTest)
    {
        $data = $this->patientDiagnosisTestRepository->getSettingList();
        $data['patientDiagnosisTest'] = $patientDiagnosisTest;
        $data['patientDiagnosisTests'] = $this->patientDiagnosisTestRepository->getPatientDiagnosisTestProperty($patientDiagnosisTest->id);

        $pdf = PDF::loadView('employees.patient_diagnosis_test.diagnosis_test_pdf', $data);

        return $pdf->stream($patientDiagnosisTest->patient->user->full_name.'-'.$patientDiagnosisTest->report_number);
    }
}
