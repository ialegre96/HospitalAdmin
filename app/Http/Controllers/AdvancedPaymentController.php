<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateAdvancedPaymentRequest;
use App\Http\Requests\UpdateAdvancedPaymentRequest;
use App\Models\AdvancedPayment;
use App\Models\User;
use App\Queries\AdvancedPaymentDataTable;
use App\Repositories\AdvancedPaymentRepository;
use DataTables;
use Exception;
use Flash;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Schema;
use Illuminate\View\View;
use Str;

class AdvancedPaymentController extends AppBaseController
{
    /** @var AdvancedPaymentRepository */
    private $advancedPaymentRepository;

    public function __construct(AdvancedPaymentRepository $advancedPaymentRepo)
    {
        $this->advancedPaymentRepository = $advancedPaymentRepo;
    }

    /**
     * Display a listing of the AdvancedPayment.
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
            return Datatables::of((new AdvancedPaymentDataTable())->get())->addColumn(User::IMG_COLUMN,
                function (AdvancedPayment $advancedPayment) {
                    return $advancedPayment->patient->user->image_url;
                })->make(true);
        }

        $receiptNo = strtoupper(Str::random(8));
        $patients = $this->advancedPaymentRepository->getPatients();

        return view('advanced_payments.index', compact('receiptNo', 'patients'));
    }

    /**
     * Store a newly created AdvancedPayment in storage.
     *
     * @param  CreateAdvancedPaymentRequest  $request
     *
     * @return JsonResponse
     */
    public function store(CreateAdvancedPaymentRequest $request)
    {
        $input = $request->all();
        $input['amount'] = removeCommaFromNumbers($input['amount']);
        Schema::disableForeignKeyConstraints();
        $this->advancedPaymentRepository->create($input);
        Schema::enableForeignKeyConstraints();
        $this->advancedPaymentRepository->createNotification($input);

        return $this->sendSuccess('Advanced Payment saved successfully.');
    }

    /**
     * @param  AdvancedPayment  $advancedPayment
     *
     * @return Factory|RedirectResponse|Redirector|View
     */
    public function show(AdvancedPayment $advancedPayment)
    {
        $advancedPayment = $this->advancedPaymentRepository->find($advancedPayment->id);
        if (empty($advancedPayment)) {
            Flash::error('Advanced Payment not found');

            return redirect(route('advancedPayments.index'));
        }
        $patients = $this->advancedPaymentRepository->getPatients();

        return view('advanced_payments.show')->with(['advancedPayment' => $advancedPayment, 'patients' => $patients]);
    }

    /**
     * Show the form for editing the specified AdvancedPayment.
     *
     * @param  AdvancedPayment  $advancedPayment
     *
     * @return JsonResponse
     */
    public function edit(AdvancedPayment $advancedPayment)
    {
        return $this->sendResponse($advancedPayment, 'Advance Payment retrieved successfully.');
    }

    /**
     * @param  AdvancedPayment  $advancedPayment
     * @param  UpdateAdvancedPaymentRequest  $request
     *
     * @return JsonResponse
     */
    public function update(AdvancedPayment $advancedPayment, UpdateAdvancedPaymentRequest $request)
    {
        $input = $request->all();
        $input['amount'] = removeCommaFromNumbers($input['amount']);
        Schema::disableForeignKeyConstraints();
        $this->advancedPaymentRepository->update($input, $advancedPayment->id);
        Schema::enableForeignKeyConstraints();

        return $this->sendSuccess('Advanced Payment updated successfully.');
    }

    /**
     * Remove the specified AdvancedPayment from storage.
     *
     * @param  AdvancedPayment  $advancedPayment
     *
     * @throws Exception
     *
     * @return JsonResponse
     */
    public function destroy(AdvancedPayment $advancedPayment)
    {
        $advancedPayment->delete();

        return $this->sendSuccess('AdvancedPayment deleted successfully.');
    }
}
