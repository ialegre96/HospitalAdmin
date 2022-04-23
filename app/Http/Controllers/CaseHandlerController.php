<?php

namespace App\Http\Controllers;

use App\Exports\CaseHandlerExport;
use App\Http\Requests\CreateCaseHandlerRequest;
use App\Http\Requests\UpdateCaseHandlerRequest;
use App\Models\CaseHandler;
use App\Models\EmployeePayroll;
use App\Models\User;
use App\Queries\CaseHandlerDataTable;
use App\Repositories\CaseHandlerRepository;
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

class CaseHandlerController extends AppBaseController
{
    /** @var CaseHandlerRepository */
    private $caseHandlerRepository;

    public function __construct(CaseHandlerRepository $caseHandlerRepo)
    {
        $this->caseHandlerRepository = $caseHandlerRepo;
    }

    /**
     * Display a listing of the CaseHandler.
     *
     * @param  Request  $request
     *
     * @throws Exception
     * @return Factory|View
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            return Datatables::of((new CaseHandlerDataTable())->get($request->only(['status'])))
                ->addColumn(User::IMG_COLUMN, function (CaseHandler $caseHandler) {
                    return $caseHandler->user->image_url;
                })->make(true);
        }
        $data['statusArr'] = CaseHandler::STATUS_ARR;

        return view('case_handlers.index', $data);
    }

    /**
     * Show the form for creating a new CaseHandler.
     * @return Factory|View
     */
    public function create()
    {
        $bloodGroup = getBloodGroups();

        return view('case_handlers.create', compact('bloodGroup'));
    }

    /**
     * Store a newly created CaseHandler in storage.
     *
     * @param  CreateCaseHandlerRequest  $request
     *
     * @return RedirectResponse|Redirector
     */
    public function store(CreateCaseHandlerRequest $request)
    {
        $input = $request->all();
        $input['status'] = ! isset($input['status']) ? 0 : 1;
        $this->caseHandlerRepository->store($input);
        Flash::success('Case Handler saved successfully.');

        return redirect(route('case-handlers.index'));
    }

    /**
     * Display the specified CaseHandler.
     *
     * @param  CaseHandler  $caseHandler
     *
     * @return Factory|View
     */
    public function show(CaseHandler $caseHandler)
    {
        $payrolls = $caseHandler->payrolls;

        return view('case_handlers.show', compact('caseHandler', 'payrolls'));
    }

    /**
     * Show the form for editing the specified CaseHandler.
     *
     * @param  CaseHandler  $caseHandler
     *
     * @return Factory|View
     */
    public function edit(CaseHandler $caseHandler)
    {
        $user = $caseHandler->user;
        $bloodGroup = getBloodGroups();

        return view('case_handlers.edit', compact('user', 'caseHandler', 'bloodGroup'));
    }

    /**
     * Update the specified CaseHandler in storage.
     *
     * @param  CaseHandler  $caseHandler
     * @param  UpdateCaseHandlerRequest  $request
     *
     * @return RedirectResponse|Redirector
     */
    public function update(CaseHandler $caseHandler, UpdateCaseHandlerRequest $request)
    {
        $input = $request->all();
        $input['status'] = isset($input['status']) ? 1 : 0;
        $this->caseHandlerRepository->update($caseHandler, $input);
        Flash::success('Case Handler updated successfully.');

        return redirect(route('case-handlers.index'));
    }

    /**
     * Remove the specified CaseHandler from storage.
     *
     * @param  CaseHandler  $caseHandler
     *
     * @throws Exception
     * @return JsonResponse
     */
    public function destroy(CaseHandler $caseHandler)
    {
        $caseHandlersModels = [
            EmployeePayroll::class,
        ];
        $result = canDelete($caseHandlersModels, 'owner_id', $caseHandler->id);
        if ($result) {
            return $this->sendError('Case Handler can\'t be deleted.');
        }

        $caseHandler->user()->delete();
        $caseHandler->address()->delete();
        $caseHandler->delete();

        return $this->sendSuccess('Case Handler deleted successfully.');
    }

    /**
     * @param  int  $id
     *
     * @return JsonResponse
     */
    public function activeDeactiveStatus($id)
    {
        $caseHandler = CaseHandler::findOrFail($id);
        $status = ! $caseHandler->user->status;
        $caseHandler->user()->update(['status' => $status]);

        return $this->sendSuccess('Status updated successfully.');
    }

    /**
     * @return BinaryFileResponse
     */
    public function caseHandlerExport()
    {
        return Excel::download(new CaseHandlerExport, 'case-handlers-'.time().'.xlsx');
    }
}
