<?php

namespace App\Http\Controllers;

use App\Exports\PharmacistExport;
use App\Http\Requests\CreatePharmacistRequest;
use App\Http\Requests\UpdatePharmacistRequest;
use App\Models\EmployeePayroll;
use App\Models\Pharmacist;
use App\Models\User;
use App\Queries\PharmacistDataTable;
use App\Repositories\PharmacistRepository;
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

class PharmacistController extends AppBaseController
{
    /** @var PharmacistRepository */
    private $pharmacistRepository;

    public function __construct(PharmacistRepository $pharmacistRepo)
    {
        $this->pharmacistRepository = $pharmacistRepo;
    }

    /**
     * Display a listing of the Pharmacist.
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
            return Datatables::of((new PharmacistDataTable())->get($request->only(['status'])))
                ->addColumn(User::IMG_COLUMN, function (Pharmacist $pharmacist) {
                    return $pharmacist->user->image_url;
                })->make(true);
        }
        $data['statusArr'] = Pharmacist::STATUS_ARR;

        return view('pharmacists.index', $data);
    }

    /**
     * Show the form for creating a new Pharmacist.
     *
     * @return Factory|View
     */
    public function create()
    {
        $bloodGroup = getBloodGroups();

        return view('pharmacists.create', compact('bloodGroup'));
    }

    /**
     * Store a newly created Pharmacist in storage.
     *
     * @param  CreatePharmacistRequest  $request
     *
     * @return RedirectResponse|Redirector
     */
    public function store(CreatePharmacistRequest $request)
    {
        $input = $request->all();
        $input['status'] = isset($input['status']) ? 1 : 0;

        $this->pharmacistRepository->store($input);
        Flash::success('Pharmacist saved successfully.');

        return redirect(route('pharmacists.index'));
    }

    /**
     * Display the specified Pharmacist.
     *
     * @param  int  $id
     *
     * @return Factory|View
     */
    public function show($id)
    {
        $pharmacist = Pharmacist::findOrFail($id);
        $payrolls = $pharmacist->payrolls;

        return view('pharmacists.show', compact('pharmacist', 'payrolls'));
    }

    /**
     * Show the form for editing the specified Pharmacist.
     *
     * @param  int  $id
     *
     * @return Factory|View
     */
    public function edit($id)
    {
        $pharmacist = Pharmacist::findOrFail($id);
        $user = $pharmacist->user;
        $bloodGroup = getBloodGroups();

        return view('pharmacists.edit', compact('pharmacist', 'user', 'bloodGroup'));
    }

    /**
     * Update the specified Pharmacist in storage.
     *
     * @param  Pharmacist  $pharmacist
     * @param  UpdatePharmacistRequest  $request
     *
     * @return RedirectResponse|Redirector
     */
    public function update(Pharmacist $pharmacist, UpdatePharmacistRequest $request)
    {
        $input = $request->all();
        $input['status'] = isset($input['status']) ? 1 : 0;
        $this->pharmacistRepository->update($input, $pharmacist);

        Flash::success('Pharmacist updated successfully.');

        return redirect(route('pharmacists.index'));
    }

    /**
     * Remove the specified Pharmacist from storage.
     *
     * @param  Pharmacist  $pharmacist
     *
     * @throws Exception
     *
     * @return JsonResponse
     */
    public function destroy(Pharmacist $pharmacist)
    {
        $empPayRollResult = canDeletePayroll(EmployeePayroll::class, 'owner_id', $pharmacist->id);
        if ($empPayRollResult) {
            return $this->sendError('Pharmacist can\'t be deleted.');
        }
        $pharmacist->user()->delete();
        $pharmacist->delete();
        $pharmacist->address()->delete();

        return $this->sendSuccess('Pharmacist deleted successfully.');
    }

    /**
     * @param  int  $id
     *
     * @return JsonResponse
     */
    public function activeDeactiveStatus($id)
    {
        $pharmacist = Pharmacist::findOrFail($id);
        $status = ! $pharmacist->user->status;
        $pharmacist->user()->update(['status' => $status]);

        return $this->sendSuccess('Status updated successfully.');
    }

    /**
     * @return BinaryFileResponse
     */
    public function pharmacistExport()
    {
        return Excel::download(new PharmacistExport, 'pharmacists-'.time().'.xlsx');
    }
}
