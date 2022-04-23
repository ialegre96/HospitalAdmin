<?php

namespace App\Http\Controllers;

use App\Exports\ReceptionistExport;
use App\Http\Requests\CreateReceptionistRequest;
use App\Http\Requests\UpdateReceptionistRequest;
use App\Models\EmployeePayroll;
use App\Models\Receptionist;
use App\Models\User;
use App\Queries\ReceptionistDataTable;
use App\Repositories\ReceptionistRepository;
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

class ReceptionistController extends AppBaseController
{
    /** @var ReceptionistRepository */
    private $receptionistRepository;

    public function __construct(ReceptionistRepository $receptionistRepo)
    {
        $this->receptionistRepository = $receptionistRepo;
    }

    /**
     * Display a listing of the Receptionist.
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
            return Datatables::of((new ReceptionistDataTable())->get($request->only(['status'])))
                ->addColumn(User::IMG_COLUMN, function (Receptionist $receptionist) {
                    return $receptionist->user->image_url;
                })->make(true);
        }
        $data['statusArr'] = Receptionist::STATUS_ARR;

        return view('receptionists.index', $data);
    }

    /**
     * Show the form for creating a new Receptionist.
     *
     * @return Factory|View
     */
    public function create()
    {
        $bloodGroup = getBloodGroups();

        return view('receptionists.create', compact('bloodGroup'));
    }

    /**
     * Store a newly created Receptionist in storage.
     *
     * @param  CreateReceptionistRequest  $request
     *
     * @return RedirectResponse|Redirector
     */
    public function store(CreateReceptionistRequest $request)
    {
        $input = $request->all();
        $input['status'] = isset($input['status']) ? 1 : 0;

        $receptionist = $this->receptionistRepository->store($input);

        Flash::success('Receptionist saved successfully.');

        return redirect(route('receptionists.index'));
    }

    /**
     * Display the specified Receptionist.
     *
     * @param  int  $id
     *
     * @return Factory|View
     */
    public function show($id)
    {
        $receptionist = Receptionist::findOrFail($id);
        $payrolls = $receptionist->payrolls;

        return view('receptionists.show', compact('receptionist', 'payrolls'));
    }

    /**
     * Show the form for editing the specified Receptionist.
     *
     * @param  int  $id
     *
     * @return Factory|View
     */
    public function edit($id)
    {
        $receptionist = Receptionist::findOrFail($id);
        $user = $receptionist->user;
        $bloodGroup = getBloodGroups();

        return view('receptionists.edit', compact('receptionist', 'user', 'bloodGroup'));
    }

    /**
     * Update the specified Receptionist in storage.
     *
     * @param  Receptionist  $receptionist
     * @param  UpdateReceptionistRequest  $request
     *
     * @return RedirectResponse|Redirector
     */
    public function update(Receptionist $receptionist, UpdateReceptionistRequest $request)
    {
        $input = $request->all();
        $input['status'] = isset($input['status']) ? 1 : 0;

        $receptionist = $this->receptionistRepository->update($receptionist, $input);

        Flash::success('Receptionist updated successfully.');

        return redirect(route('receptionists.index'));
    }

    /**
     * Remove the specified Receptionist from storage.
     *
     * @param  Receptionist  $receptionist
     *
     * @throws Exception
     *
     * @return JsonResponse
     */
    public function destroy(Receptionist $receptionist)
    {
        $empPayRollResult = canDeletePayroll(EmployeePayroll::class, 'owner_id', $receptionist->id);
        if ($empPayRollResult) {
            return $this->sendError('Receptionist can\'t be deleted.');
        }
        $receptionist->user()->delete();
        $receptionist->address()->delete();
        $receptionist->delete();

        return $this->sendSuccess('Receptionist deleted successfully.');
    }

    /**
     * @param  int  $id
     *
     * @return JsonResponse
     */
    public function activeDeactiveStatus($id)
    {
        $receptionist = Receptionist::findOrFail($id);
        $status = ! $receptionist->user->status;
        $receptionist->user()->update(['status' => $status]);

        return $this->sendSuccess('Status updated successfully.');
    }

    /**
     * @return BinaryFileResponse
     */
    public function receptionistExport()
    {
        return Excel::download(new ReceptionistExport, 'receptionists-'.time().'.xlsx');
    }
}
