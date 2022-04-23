<?php

namespace App\Http\Controllers;

use App\Exports\BloodBankExport;
use App\Http\Requests\CreateBloodBankRequest;
use App\Http\Requests\UpdateBloodBankRequest;
use App\Models\BloodBank;
use App\Models\BloodDonor;
use App\Models\User;
use App\Queries\BloodBankDataTable;
use App\Repositories\BloodBankRepository;
use DataTables;
use Exception;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class BloodBankController extends AppBaseController
{
    /** @var BloodBankRepository */
    private $bloodBankRepository;

    public function __construct(BloodBankRepository $bloodBankRepo)
    {
        $this->middleware('check_menu_access');
        $this->bloodBankRepository = $bloodBankRepo;
    }

    /**
     * Display a listing of the BloodBank.
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
            return Datatables::of((new BloodBankDataTable())->get())->make(true);
        }

        return view('blood_banks.index');
    }

    /**
     * Store a newly created BloodBank in storage.
     *
     * @param  CreateBloodBankRequest  $request
     *
     * @return JsonResponse
     */
    public function store(CreateBloodBankRequest $request)
    {
        $input = $request->all();
        $this->bloodBankRepository->create($input);

        return $this->sendSuccess('Blood group saved successfully.');
    }

    /**
     * Show the form for editing the specified BloodBank.
     *
     * @param  BloodBank  $bloodBank
     *
     * @return JsonResponse
     */
    public function edit(BloodBank $bloodBank)
    {
        return $this->sendResponse($bloodBank, 'BloodBank retrieved successfully.');
    }

    /**
     * Update the specified BloodBank in storage.
     *
     * @param  BloodBank  $bloodBank
     * @param  UpdateBloodBankRequest  $request
     *
     * @return JsonResponse
     */
    public function update(BloodBank $bloodBank, UpdateBloodBankRequest $request)
    {
        $input = $request->all();
        $this->bloodBankRepository->update($input, $bloodBank->id);

        return $this->sendSuccess('Blood group updated successfully.');
    }

    /**
     * Remove the specified BloodBank from storage.
     *
     * @param  BloodBank  $bloodBank
     *
     * @throws Exception
     *
     * @return JsonResponse
     */
    public function destroy(BloodBank $bloodBank)
    {
        $bloodBankModel = [
            BloodDonor::class, User::class,
        ];
        $result = canDelete($bloodBankModel, 'blood_group', $bloodBank->blood_group);
        if ($result) {
            return $this->sendError('Blood Bank can\'t be deleted.');
        }
        $bloodBank->delete($bloodBank->id);

        return $this->sendSuccess('Blood Bank deleted successfully.');
    }

    /**
     * @return BinaryFileResponse
     */
    public function bloodBankExport()
    {
        return Excel::download(new BloodBankExport, 'blood-banks-'.time().'.xlsx');
    }
}
