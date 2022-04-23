<?php

namespace App\Http\Controllers\Patient;

use App\Http\Controllers\Controller;
use App\Models\PatientCase;
use App\Queries\PatientCaseDataTable;
use DataTables;
use Exception;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PatientCaseController extends Controller
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
            return Datatables::of((new PatientCaseDataTable())->get())
                ->addColumn('patientImageUrl', function (PatientCase $patientCase) {
                    return $patientCase->patient->user->image_url;
                })->addColumn('doctorImageUrl', function (PatientCase $patientCase) {
                    return $patientCase->doctor->user->image_url;
                })->make(true);
        }

        return view('patients_cases_list.index');
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
        $patientCase = PatientCase::findOrFail($id);

        return view('patients_cases_list.show')->with('patientCase', $patientCase);
    }
}
