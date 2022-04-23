<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateBillRequest;
use App\Http\Requests\UpdateBillRequest;
use App\Models\Bill;
use App\Models\Patient;
use App\Models\User;
use App\Queries\BillDataTable;
use App\Repositories\BillRepository;
use Barryvdh\DomPDF\Facade as PDF;
use Carbon\Carbon;
use DataTables;
use DB;
use Exception;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\JsonResponse;
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
            return DataTables::of((new BillDataTable())->get())->addColumn(User::IMG_COLUMN, function (Bill $bill) {
                return $bill->patient->user->image_url;
            })->make(true);
        }

        return view('bills.index');
    }

    /**
     * Show the form for creating a new Bill.
     *
     * @return Factory|View
     */
    public function create()
    {
        $data = $this->billRepository->getSyncList(false);

        return view('bills.create')->with($data);
    }

    /**
     * Store a newly created Bill in storage.
     *
     * @param  CreateBillRequest  $request
     *
     * @throws Exception
     *
     * @return JsonResponse
     */
    public function store(CreateBillRequest $request)
    {
        try {
            DB::beginTransaction();
            $input = $request->all();
            $patientId = Patient::with('user')->whereId($input['patient_id'])->first();
            $birthDate = $patientId->user->dob;
            $billDate = Carbon::parse($input['bill_date'])->toDateString();
            if (! empty($birthDate) && $billDate < $birthDate) {
                return $this->sendError('Bill date should not be smaller than patient birth date.');
            }
            $bill = $this->billRepository->saveBill($request->all());
            $this->billRepository->saveNotification($input);
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();

            return $this->sendError($e->getMessage());
        }

        return $this->sendResponse($bill, 'Bill saved successfully.');
    }

    /**
     * Display the specified Bill.
     *
     * @param  int  $id
     *
     * @return Factory|View
     */
    public function show($id)
    {
        $bill = Bill::with(['billItems.medicine', 'patient', 'patientAdmission'])->findOrFail($id);
        $admissionDate = Carbon::parse($bill->patientAdmission->admission_date);
        $dischargeDate = Carbon::parse($bill->patientAdmission->discharge_date);
        $bill->totalDays = $admissionDate->diffInDays($dischargeDate) + 1;

        return view('bills.show')->with('bill', $bill);
    }

    /**
     * Show the form for editing the specified Bill.
     *
     * @param  int  $id
     *
     * @return Factory|View
     */
    public function edit($id)
    {
        $bill = Bill::findOrFail($id);
        $bill->billItems;
        $isEdit = true;
        $data = $this->billRepository->getSyncList($isEdit);
        $data['bill'] = $bill;

        return view('bills.edit')->with($data);
    }

    /**
     * Update the specified Bill in storage.
     *
     * @param  Bill  $bill
     * @param  UpdateBillRequest  $request
     *
     * @throws Exception
     *
     * @return JsonResponse
     */
    public function update(Bill $bill, UpdateBillRequest $request)
    {
        try {
            DB::beginTransaction();
            $input = $request->all();
            $patientId = Patient::with('user')->whereId($input['patient_id'])->first();
            $birthDate = $patientId->user->dob;
            $billDate = Carbon::parse($input['bill_date'])->toDateString();
            if (! empty($birthDate) && $billDate < $birthDate) {
                return $this->sendError('Bill date should not be smaller than patient birth date.');
            }
            $bill = $this->billRepository->updateBill($bill->id, $request->all());
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();

            return $this->sendError($e->getMessage());
        }

        return $this->sendResponse($bill, 'Bill updated successfully.');
    }

    /**
     * Remove the specified Bill from storage.
     *
     * @param  Bill  $bill
     * @throws Exception
     *
     * @return JsonResponse
     */
    public function destroy(Bill $bill)
    {
        $this->billRepository->delete($bill->id);

        return $this->sendSuccess('Bill deleted successfully.');
    }

    /**
     * @param  Request  $request
     *
     * @return JsonResponse
     */
    public function getPatientAdmissionDetails(Request $request)
    {
        $inputs = $request->all();
        $patientAdmissionDetails = $this->billRepository->patientAdmissionDetails($inputs);

        return $this->sendResponse($patientAdmissionDetails, 'Details retrieved successfully.');
    }

    /**
     * @param  Bill  $bill
     *
     * @return \Illuminate\Http\Response
     */
    public function convertToPdf(Bill $bill)
    {
        $bill->billItems;
        $data = $this->billRepository->getSyncListForCreate($bill->id);
        $data['bill'] = $bill;
        $pdf = PDF::loadView('bills.bill_pdf', $data);

        return $pdf->stream('bill.pdf');
    }
}
