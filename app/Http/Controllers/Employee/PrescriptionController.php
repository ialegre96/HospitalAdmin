<?php

namespace App\Http\Controllers\Employee;

use App\Exports\PrescriptionExport;
use App\Http\Controllers\Controller;
use App\Models\Prescription;
use App\Queries\PrescriptionDataTable;
use DataTables;
use Exception;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class PrescriptionController extends Controller
{
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
            return Datatables::of((new PrescriptionDataTable())->get())
                ->addColumn('patientImageUrl', function (Prescription $prescription) {
                    return $prescription->patient->user->image_url;
                })->addColumn('doctorImageUrl', function (Prescription $prescription) {
                    return $prescription->doctor->user->image_url;
                })->make(true);
        }

        return view('employee_prescription_list.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return Factory|View
     */
    public function show($id)
    {
        $prescription = Prescription::findOrFail($id);

        return view('employee_prescription_list.show')->with('prescription', $prescription);
    }

    /**
     * @return BinaryFileResponse
     */
    public function prescriptionExport()
    {
        return Excel::download(new PrescriptionExport, 'prescriptions-'.time().'.xlsx');
    }
}
