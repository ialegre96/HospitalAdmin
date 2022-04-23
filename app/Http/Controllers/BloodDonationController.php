<?php

namespace App\Http\Controllers;

use App\Exports\BloodDonationExport;
use App\Http\Requests\BloodDonationRequest;
use App\Models\BloodDonation;
use App\Models\BloodDonor;
use App\Queries\BloodDonationDatatable;
use App\Repositories\BloodDonationRepository;
use DataTables;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;
use Maatwebsite\Excel\Facades\Excel;

/**
 * Class BloodDonationController
 */
class BloodDonationController extends AppBaseController
{
    /** @var BloodDonationRepository */
    private $bloodDonationRepository;

    /**
     * BloodDonationController constructor.
     *
     * @param  BloodDonationRepository  $bloodDonationRepository
     */
    public function __construct(BloodDonationRepository $bloodDonationRepository)
    {
        $this->middleware('check_menu_access');
        $this->bloodDonationRepository = $bloodDonationRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @param  Request  $request
     *
     * @return Application|Factory|Response|View
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            return Datatables::of((new BloodDonationDatatable())->get())->make(true);
        }
        $donorName = BloodDonor::orderBy('name')->pluck('name', 'id')->toArray();

        return view('blood_donations.index', compact('donorName'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  BloodDonationRequest  $request
     *
     * @return JsonResponse
     */
    public function store(BloodDonationRequest $request)
    {
        try {
            $input = $request->all();
            $this->bloodDonationRepository->createBloodDonation($input);

            return $this->sendSuccess('Blood Donation saved successfully.');
        } catch (Exception $e) {
            return $this->sendError($e->getMessage());
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  BloodDonation  $bloodDonation
     *
     * @return JsonResponse
     */
    public function edit(BloodDonation $bloodDonation)
    {
        return $this->sendResponse($bloodDonation, 'Blood Donation retrieved successfully.');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  BloodDonationRequest  $request
     * @param  BloodDonation  $bloodDonation
     *
     * @return JsonResponse
     */
    public function update(BloodDonationRequest $request, BloodDonation $bloodDonation)
    {
        try {
            $input = $request->all();
            $this->bloodDonationRepository->updateBloodDonation($input, $bloodDonation);

            return $this->sendSuccess('Blood Donation updated successfully.');
        } catch (Exception $e) {
            return $this->sendError($e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  BloodDonation  $bloodDonation
     *
     * @throws Exception
     *
     * @return JsonResponse
     */
    public function destroy(BloodDonation $bloodDonation)
    {
        try {
            $bloodDonation->delete($bloodDonation->id);

            return $this->sendSuccess('Blood Donation deleted successfully.');
        } catch (Exception $e) {
            return $this->sendError($e->getMessage());
        }
    }

    /*
     * @return BinaryFileResponse
     */
    public function bloodDonationExport()
    {
        return Excel::download(new BloodDonationExport, 'blood-donations-'.time().'.xlsx');
    }
}
