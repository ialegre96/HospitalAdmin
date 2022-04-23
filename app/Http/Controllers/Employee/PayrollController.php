<?php

namespace App\Http\Controllers\Employee;

use App\Exports\UserPayrollExport;
use App\Http\Controllers\Controller;
use App\Queries\EmployeePayrollDataTable;
use DataTables;
use Exception;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class PayrollController extends Controller
{
    /**
     * @param  Request  $request
     *
     * @throws Exception
     * @return Factory|View
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            return Datatables::of((new EmployeePayrollDataTable())->get())->make(true);
        }

        return view('employees.payrolls.index');
    }

    /**
     * @return BinaryFileResponse
     */
    public function userPayrollExport()
    {
        return Excel::download(new UserPayrollExport, getLoggedInUser()->full_name.'-payroll-'.time().'.xlsx');
    }
}
