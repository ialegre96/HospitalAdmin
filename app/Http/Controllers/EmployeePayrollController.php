<?php

namespace App\Http\Controllers;

use App\Exports\EmployeePayrollExport;
use App\Http\Requests\CreateEmployeePayrollRequest;
use App\Http\Requests\UpdateEmployeePayrollRequest;
use App\Models\EmployeePayroll;
use App\Models\User;
use App\Queries\EmployeePayrollDataTable;
use App\Repositories\EmployeePayrollRepository;
use DataTables;
use Exception;
use Flash;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Str;
use Illuminate\View\View;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class EmployeePayrollController extends AppBaseController
{
    /** @var EmployeePayrollRepository */
    private $employeePayrollRepository;

    public function __construct(EmployeePayrollRepository $employeePayrollRepo)
    {
        $this->employeePayrollRepository = $employeePayrollRepo;
    }

    /**
     * Display a listing of the EmployeePayroll.
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
            return Datatables::of((new EmployeePayrollDataTable())->get($request->only(['status'])))
                ->addColumn(User::IMG_COLUMN, function (EmployeePayroll $employeePayroll) {
                    return $employeePayroll->owner->user->image_url;
                })->make(true);
        }
        $data['statusArr'] = EmployeePayroll::STATUS_ARR;

        return view('employee_payrolls.index', $data);
    }

    /**
     * Show the form for creating a new EmployeePayroll.
     *
     * @return Factory|View
     */
    public function create()
    {
        $srNo = EmployeePayroll::orderBy('id', 'desc')->value('id');
        $srNo = (! $srNo) ? 1 : $srNo + 1;
        $payrollId = strtoupper(Str::random(8));
        $types = EmployeePayroll::TYPES;
        asort($types);
        $months = EmployeePayroll::MONTHS;
        $status = EmployeePayroll::STATUS;

        return view('employee_payrolls.create', compact('srNo', 'payrollId', 'types', 'months', 'status'));
    }

    /**
     * Store a newly created EmployeePayroll in storage.
     *
     * @param  CreateEmployeePayrollRequest  $request
     *
     * @return RedirectResponse|Redirector
     */
    public function store(CreateEmployeePayrollRequest $request)
    {
        $input = $request->all();
        $this->employeePayrollRepository->create($input);
        $this->employeePayrollRepository->createNotification($input);
        Flash::success('Employee Payroll saved successfully.');

        return redirect(route('employee-payrolls.index'));
    }

    /**
     * @param  EmployeePayroll  $employeePayroll
     *
     * @return Factory|RedirectResponse|Redirector|View
     */
    public function show(EmployeePayroll $employeePayroll)
    {
        return view('employee_payrolls.show')->with('employeePayroll', $employeePayroll);
    }

    /**
     * Show the form for editing the specified EmployeePayroll.
     *
     * @param  EmployeePayroll  $employeePayroll
     *
     * @return Factory|View
     */
    public function edit(EmployeePayroll $employeePayroll)
    {
        $types = EmployeePayroll::TYPES;
        $status = EmployeePayroll::STATUS;
        $employeePayroll->month = array_search($employeePayroll->month, EmployeePayroll::MONTHS);

        return view('employee_payrolls.edit', compact('employeePayroll', 'types', 'status'));
    }

    /**
     * Update the specified EmployeePayroll in storage.
     *
     * @param  EmployeePayroll  $employeePayroll
     * @param  UpdateEmployeePayrollRequest  $request
     *
     * @return RedirectResponse|Redirector
     */
    public function update(EmployeePayroll $employeePayroll, UpdateEmployeePayrollRequest $request)
    {
        $input = $request->all();
        $this->employeePayrollRepository->update($input, $employeePayroll->id);
        Flash::success('Employee Payroll updated successfully.');

        return redirect(route('employee-payrolls.index'));
    }

    /**
     * @param  EmployeePayroll  $employeePayroll
     *
     * @throws Exception
     *
     * @return JsonResponse
     */
    public function destroy(EmployeePayroll $employeePayroll)
    {
        $employeePayroll->delete();

        return $this->sendSuccess('employee-payrolls.index');
    }

    /**
     * @param  Request  $request
     *
     * @return JsonResponse
     */
    public function getEmployeesList(Request $request)
    {
        if (empty($request->get('id'))) {
            return $this->sendError('Employees List not found');
        }

        $employeesData = EmployeePayroll::CLASS_TYPES[$request->id]::with('user')
        ->get()->where('user.status', '=', 1)->pluck('user.full_name', 'id');

        return $this->sendResponse($employeesData, 'Retrieved successfully');
    }

    /**
     * @return BinaryFileResponse
     */
    public function employeePayrollExport()
    {
        return Excel::download(new EmployeePayrollExport, 'employee-payrolls-'.time().'.xlsx');
    }

    /**
     * @param  EmployeePayroll  $employeePayroll
     *
     * @return JsonResponse
     */
    public function showModal(EmployeePayroll $employeePayroll)
    {
        $employeePayroll->load(['owner.user']);

        return $this->sendResponse($employeePayroll, 'Employee Payroll Retrieved Successfully.');
    }
}
