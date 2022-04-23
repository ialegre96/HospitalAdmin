<?php

namespace App\Http\Controllers;

use App\Exports\DoctorOPDChargeExport;
use App\Http\Requests\CreateDoctorOPDChargeRequest;
use App\Http\Requests\UpdateDoctorOPDChargeRequest;
use App\Models\DoctorOPDCharge;
use App\Models\User;
use App\Queries\DoctorOPDChargeDataTable;
use App\Repositories\DoctorOPDChargeRepository;
use DataTables;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class DoctorOPDChargeController extends AppBaseController
{
    /**
     * @var DoctorOPDChargeRepository
     */
    private $doctorOPDChargeRepository;

    public function __construct(DoctorOPDChargeRepository $doctorOPDChargeRepository)
    {
        $this->doctorOPDChargeRepository = $doctorOPDChargeRepository;
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
            return DataTables::of((new DoctorOPDChargeDataTable())->get())->addColumn(User::IMG_COLUMN,
                function (DoctorOPDCharge $doctorOPDCharge) {
                    return $doctorOPDCharge->doctor->user->image_url;
                })->make(true);
        }
        $doctors = $this->doctorOPDChargeRepository->getDoctors();

        return view('doctor_opd_charges.index', compact('doctors'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CreateDoctorOPDChargeRequest  $request
     *
     * @return JsonResponse
     */
    public function store(CreateDoctorOPDChargeRequest $request)
    {
        $input = $request->all();
        $input['standard_charge'] = removeCommaFromNumbers($input['standard_charge']);
        $this->doctorOPDChargeRepository->create($input);

        return $this->sendSuccess('Doctor OPD Charge saved successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  DoctorOPDCharge  $doctorOPDCharge
     *
     * @return JsonResponse
     */
    public function edit(DoctorOPDCharge $doctorOPDCharge)
    {
        return $this->sendResponse($doctorOPDCharge, 'Doctor OPD Charge retrieved successfully.');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UpdateDoctorOPDChargeRequest  $request
     *
     * @param  DoctorOPDCharge  $doctorOPDCharge
     *
     * @return JsonResponse
     */
    public function update(UpdateDoctorOPDChargeRequest $request, DoctorOPDCharge $doctorOPDCharge)
    {
        $input = $request->all();
        $input['standard_charge'] = removeCommaFromNumbers($input['standard_charge']);
        $this->doctorOPDChargeRepository->update($input, $doctorOPDCharge->id);

        return $this->sendSuccess('Doctor OPD Charge updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  DoctorOPDCharge  $doctorOPDCharge
     *
     * @throws \Exception
     *
     * @return JsonResponse
     */
    public function destroy(DoctorOPDCharge $doctorOPDCharge)
    {
        $doctorOPDCharge->delete();

        return $this->sendSuccess('Doctor OPD Charge delete successfully');
    }

    /**
     * @return BinaryFileResponse
     */
    public function doctorOPDChargeExport()
    {
        return Excel::download(new DoctorOPDChargeExport, 'doctor-opd-charges-'.time().'.xlsx');
    }
}
