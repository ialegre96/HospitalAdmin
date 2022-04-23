<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateAccountantRequest;
use App\Http\Requests\UpdateAccountantRequest;
use App\Models\Account;
use App\Models\Accountant;
use App\Models\EmployeePayroll;
use App\Models\User;
use App\Queries\AccountantDataTable;
use App\Repositories\AccountantRepository;
use DataTables;
use Exception;
use Flash;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\View\View;

class AccountantController extends AppBaseController
{
    /** @var AccountantRepository */
    private $accountantRepository;

    public function __construct(AccountantRepository $accountantRepo)
    {
        $this->accountantRepository = $accountantRepo;
    }

    /**
     * Display a listing of the Accountant.
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
            return Datatables::of((new AccountantDataTable())->get($request->only(['status'])))
                ->addColumn(User::IMG_COLUMN, function (Accountant $accountant) {
                    return $accountant->user->image_url;
                })->make(true);
        }
        $data['statusArr'] = Accountant::STATUS_ARR;

        return view('accountants.index', $data);
    }

    /**
     * Show the form for creating a new Accountant.
     *
     * @return Factory|View
     */
    public function create()
    {
        $bloodGroup = getBloodGroups();

        return view('accountants.create', compact('bloodGroup'));
    }

    /**
     * Store a newly created Accountant in storage.
     *
     * @param  CreateAccountantRequest  $request
     *
     * @return RedirectResponse|Redirector
     */
    public function store(CreateAccountantRequest $request)
    {
        $input = $request->all();
        $input['status'] = isset($input['status']) ? 1 : 0;

        $accountant = $this->accountantRepository->store($input);

        Flash::success('Accountant saved successfully.');

        return redirect(route('accountants.index'));
    }

    /**
     * Display the specified Accountant.
     *
     * @param  Accountant  $accountant
     *
     * @return Factory|View
     */
    public function show(Accountant $accountant)
    {
        $payrolls = $accountant->payrolls;

        return view('accountants.show', compact('accountant', 'payrolls'));
    }

    /**
     * Show the form for editing the specified Accountant.
     *
     * @param  Accountant  $accountant
     *
     * @return Factory|View
     */
    public function edit(Accountant $accountant)
    {
        $user = $accountant->user;
        $bloodGroup = getBloodGroups();

        return view('accountants.edit', compact('user', 'accountant', 'bloodGroup'));
    }

    /**
     * Update the specified Accountant in storage.
     *
     * @param  Accountant  $accountant
     * @param  UpdateAccountantRequest  $request
     *
     * @return RedirectResponse|Redirector
     */
    public function update(Accountant $accountant, UpdateAccountantRequest $request)
    {
        $input = $request->all();
        $input['status'] = isset($input['status']) ? 1 : 0;

        $accountant = $this->accountantRepository->update($accountant, $input);

        Flash::success('Accountant updated successfully.');

        return redirect(route('accountants.index'));
    }

    /**
     * Remove the specified Accountant from storage.
     *
     * @param  Accountant  $accountant
     *
     * @throws Exception
     *
     * @return JsonResponse
     */
    public function destroy(Accountant $accountant)
    {
        $empPayRollResult = canDeletePayroll(EmployeePayroll::class, 'owner_id', $accountant->id);
        if ($empPayRollResult) {
            return $this->sendError('Accountant can\'t be deleted.');
        }
        $accountant->user()->delete();
        $accountant->address()->delete();
        $accountant->delete();

        return $this->sendSuccess('Accountant deleted successfully.');
    }

    /**
     * @param  int  $id
     *
     * @return JsonResponse
     */
    public function activeDeactiveStatus($id)
    {
        $accountant = Accountant::findOrFail($id);
        $status = ! $accountant->user->status;
        $accountant->user()->update(['status' => $status]);

        return $this->sendSuccess('Status updated successfully.');
    }
}
