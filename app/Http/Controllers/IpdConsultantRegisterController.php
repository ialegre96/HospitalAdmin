<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateIpdConsultantRegisterRequest;
use App\Http\Requests\UpdateIpdConsultantRegisterRequest;
use App\Models\IpdConsultantRegister;
use App\Queries\IpdConsultantRegisterDataTable;
use App\Repositories\IpdConsultantRegisterRepository;
use DataTables;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Response;

class IpdConsultantRegisterController extends AppBaseController
{
    /** @var IpdConsultantRegisterRepository */
    private $ipdConsultantRegisterRepository;

    public function __construct(IpdConsultantRegisterRepository $ipdConsultantRegisterRepo)
    {
        $this->ipdConsultantRegisterRepository = $ipdConsultantRegisterRepo;
    }

    /**
     * Display a listing of the IpdConsultantRegister.
     *
     * @param  Request  $request
     *
     * @throws Exception
     *
     * @return Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            return DataTables::of((new IpdConsultantRegisterDataTable())->get($request->get('id')))
                ->addColumn('doctorImageUrl', function (IpdConsultantRegister $ipdConsultantRegister) {
                    return $ipdConsultantRegister->doctor->user->image_url;
                })->make(true);
        }
    }

    /**
     * Store a newly created IpdConsultantRegister in storage.
     *
     * @param  CreateIpdConsultantRegisterRequest  $request
     *
     * @return JsonResponse
     */
    public function store(CreateIpdConsultantRegisterRequest $request)
    {
        $input = $request->all();
        $this->ipdConsultantRegisterRepository->store($input);

        return $this->sendSuccess('IPD Consultant Instruction saved successfully.');
    }

    /**
     * Show the form for editing the specified IpdPrescription.
     *
     * @param  IpdConsultantRegister  $ipdConsultantRegister
     *
     * @return JsonResponse
     */
    public function edit(IpdConsultantRegister $ipdConsultantRegister)
    {
        return $this->sendResponse($ipdConsultantRegister, 'Consultant Instruction retrieved successfully.');
    }

    /**
     * Update the specified IpdPrescriptionItem in storage.
     *
     * @param  IpdConsultantRegister  $ipdConsultantRegister
     * @param  UpdateIpdConsultantRegisterRequest  $request
     *
     * @return JsonResponse
     */
    public function update(IpdConsultantRegister $ipdConsultantRegister, UpdateIpdConsultantRegisterRequest $request)
    {
        $input = $request->all();
        $this->ipdConsultantRegisterRepository->update($input, $ipdConsultantRegister->id);

        return $this->sendSuccess('IPD Consultant Instruction updated successfully.');
    }

    /**
     * Remove the specified IpdConsultantRegister from storage.
     *
     * @param  IpdConsultantRegister  $ipdConsultantRegister
     *
     * @throws Exception
     *
     * @return JsonResponse
     */
    public function destroy(IpdConsultantRegister $ipdConsultantRegister)
    {
        $ipdConsultantRegister->delete();

        return $this->sendSuccess('IPD Consultant Instruction deleted successfully.');
    }
}
