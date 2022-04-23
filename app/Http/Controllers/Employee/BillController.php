<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\AppBaseController;
use App\Models\Bill;
use App\Queries\BillDataTable;
use App\Repositories\BillRepository;
use Barryvdh\DomPDF\Facade as PDF;
use Carbon\Carbon;
use DataTables;
use Exception;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Response;

class BillController extends AppBaseController
{
    /** @var BillRepository */
    private $billRepository;

    public function __construct(BillRepository $billRepo)
    {
        $this->billRepository = $billRepo;
    }

    /**
     * Display a listing of the Bill.
     *
     * @param  Request  $request
     * @throws Exception
     *
     * @return Factory|View|Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            return Datatables::of((new BillDataTable())->get($request->only(['status'])))
                ->addColumn('patientImageUrl', function (Bill $bill) {
                    return $bill->patient->user->image_url;
                })->make(true);
        }

        return view('employees.bills.index');
    }

    /**
     * Display the specified Bill.
     *
     * @param  Bill  $bill
     *
     * @return Factory|View
     */
    public function show(Bill $bill)
    {
        $bill = Bill::with(['billItems.medicine', 'patient'])->find($bill->id);
        $bill = Bill::with(['billItems.medicine', 'patient', 'patientAdmission'])->find($bill->id);
        $admissionDate = Carbon::parse($bill->patientAdmission->admission_date);
        $dischargeDate = Carbon::parse($bill->patientAdmission->discharge_date);
        $bill->totalDays = $admissionDate->diffInDays($dischargeDate) + 1;

        return view('employees.bills.show')->with('bill', $bill);
    }

    /**
     * @param  Bill  $bill
     *
     * @return RedirectResponse
     */
    public function convertToPdf(Bill $bill)
    {
        $bill->billItems;
        $data = $this->billRepository->getSyncListForCreate();
        $data['bill'] = $bill;
        $pdf = PDF::loadView('bills.bill_pdf', $data);

        return $pdf->stream('bill.pdf');
    }
}
