<?php

namespace App\Http\Controllers;

use App\Exports\NurseExport;
use App\Http\Requests\CreateNurseRequest;
use App\Http\Requests\UpdateNurseRequest;
use App\Models\EmployeePayroll;
use App\Models\Nurse;
use App\Models\User;
use App\Queries\NurseDataTable;
use App\Repositories\NurseRepository;
use DataTables;
use Exception;
use Flash;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\View\View;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class NurseController extends AppBaseController
{
    /** @var NurseRepository */
    private $nurseRepository;

    public function __construct(NurseRepository $nurseRepo)
    {
        $this->nurseRepository = $nurseRepo;
    }

    /**
     * Display a listing of the Nurse.
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
            return Datatables::of((new NurseDataTable())->get($request->only(['status'])))
                ->addColumn(User::IMG_COLUMN, function (Nurse $nurse) {
                    return $nurse->user->image_url;
                })->make(true);
        }
        $data['statusArr'] = Nurse::STATUS_ARR;

        return view('nurses.index', $data);
    }

    /**
     * Show the form for creating a new Nurse.
     *
     * @return Factory|View
     */
    public function create()
    {
        $bloodGroup = getBloodGroups();

        return view('nurses.create', compact('bloodGroup'));
    }

    /**
     * Store a newly created Nurse in storage.
     *
     * @param  CreateNurseRequest  $request
     *
     * @return RedirectResponse|Redirector
     */
    public function store(CreateNurseRequest $request)
    {
        $input = $request->all();
        $input['status'] = ! isset($input['status']) ? 0 : 1;

        $nurse = $this->nurseRepository->store($input);

        Flash::success('Nurse saved successfully.');

        return redirect(route('nurses.index'));
    }

    /**
     * Display the specified Nurse.
     *
     * @param  int  $id
     *
     * @return RedirectResponse|Redirector|View
     */
    public function show($id)
    {
        $nurse = Nurse::findOrFail($id);
        $payrolls = $nurse->payrolls;

        return view('nurses.show', compact('nurse', 'payrolls'));
    }

    /**
     * Show the form for editing the specified Nurse.
     *
     * @param  int  $id
     *
     * @return RedirectResponse|Redirector|View
     */
    public function edit($id)
    {
        $nurse = Nurse::findOrFail($id);
        $user = $nurse->user;
        $bloodGroup = getBloodGroups();

        return view('nurses.edit', compact('user', 'nurse', 'bloodGroup'));
    }

    /**
     * Update the specified Nurse in storage.
     *
     * @param  Nurse  $nurse
     * @param  UpdateNurseRequest  $request
     *
     * @return RedirectResponse|Redirector
     */
    public function update(Nurse $nurse, UpdateNurseRequest $request)
    {
        $input = $request->all();
        $input['status'] = isset($input['status']) ? 1 : 0;

        $user = $this->nurseRepository->update($nurse, $input);

        Flash::success('Nurse updated successfully.');

        return redirect(route('nurses.index'));
    }

    /**
     * Remove the specified Nurse from storage.
     *
     * @param  Nurse  $nurse
     *
     * @throws Exception
     *
     * @return RedirectResponse|Redirector|JsonResponse
     */
    public function destroy(Nurse $nurse)
    {
        $empPayRollResult = canDeletePayroll(EmployeePayroll::class, 'owner_id', $nurse->id);
        if ($empPayRollResult) {
            return $this->sendError('Nurse can\'t be deleted.');
        }
        $nurse->user()->delete();
        $nurse->address()->delete();
        $nurse->delete();

        return $this->sendSuccess('Nurse deleted successfully.');
    }

    /**
     * @param  int  $id
     *
     * @return JsonResponse
     */
    public function activeDeactiveStatus($id)
    {
        $nurse = Nurse::findOrFail($id);
        $status = ! $nurse->user->status;
        $nurse->user()->update(['status' => $status]);

        return $this->sendSuccess('Status updated successfully.');
    }

    /**
     * @return BinaryFileResponse
     */
    public function nurseExport()
    {
        return Excel::download(new NurseExport, 'nurses-'.time().'.xlsx');
    }
}
