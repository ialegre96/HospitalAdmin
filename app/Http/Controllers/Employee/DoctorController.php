<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Models\Doctor;
use App\Models\User;
use App\Queries\DoctorDataTable;
use DataTables;
use Exception;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\View\View;

class DoctorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  Request  $request
     *
     * @throws Exception
     * @return Factory|View
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            return Datatables::of((new DoctorDataTable())->get())
                ->addColumn(User::IMG_COLUMN, function (Doctor $doctor) {
                    return $doctor->user->image_url;
                })->make(true);
        }

        return view('employees.doctors.index');
    }

    /**
     * @param  int  $id
     *
     * @return Factory|RedirectResponse|Redirector|View
     */
    public function show($id)
    {
        $doctor = Doctor::findOrFail($id);

        return view('employees.doctors.show')->with('doctor', $doctor);
    }
}
