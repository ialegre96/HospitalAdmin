<?php

namespace App\Http\Controllers;

use App\Exports\CallLogExport;
use App\Http\Requests\CreateCallLogRequest;
use App\Http\Requests\UpdateCallLogRequest;
use App\Models\CallLog;
use App\Queries\CallLogDataTable;
use App\Repositories\CallLogRepository;
use DataTables;
use Exception;
use Flash;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Response;
use Illuminate\View\View;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

/**
 * Class CallLogController
 */
class CallLogController extends AppBaseController
{
    /**
     * @var  CallLogRepository
     */
    private $CallLogRepository;

    /**
     * CallLogController constructor.
     *
     * @param  CallLogRepository  $callLogRepo
     */
    public function __construct(CallLogRepository $callLogRepo)
    {
        $this->CallLogRepository = $callLogRepo;
    }

    /**
     * Display a listing of the resource.
     *
     * @param  Request  $request
     *
     * @throws Exception
     *
     * @return Application|Factory|Response|View
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            return Datatables::of((new CallLogDataTable())->get($request->only(['call_type'])))->make(true);
        }
        $callTypeArr = CallLog::CALLTYPE_ARR;

        return view('call_logs.index', compact('callTypeArr'));
    }

    /**
     * @return Application|Factory|View
     */
    public function create()
    {
        return view('call_logs.create');
    }

    /**
     * Store a newly created CallLog in storage.
     *
     * @param  CreateCallLogRequest  $request
     *
     * @return Application|RedirectResponse|Redirector
     */
    public function store(CreateCallLogRequest $request)
    {
        $input = $request->all();
        $input['phone'] = preparePhoneNumber($input, 'phone');
        $this->CallLogRepository->create($input);
        Flash::success('Call Log saved successfully.');

        return redirect(route('call_logs.index'));
    }

    /**
     * Show the form for editing the specified CallLog.
     *
     * @param  int  $id
     *
     * @return Application|Factory|View
     */
    public function edit($id)
    {
        $callLog = CallLog::findOrFail($id);

        return view('call_logs.edit', compact('callLog'));
    }

    /**
     * Update the specified CallLog in storage.
     *
     * @param  CallLog  $callLog
     *
     * @param  UpdateCallLogRequest  $request
     *
     * @return Application|RedirectResponse|Redirector
     */
    public function update(UpdateCallLogRequest $request, CallLog $callLog)
    {
        $input = $request->all();
        $input['phone'] = preparePhoneNumber($input, 'phone');
        $this->CallLogRepository->update($input, $callLog->id);
        Flash::success('Call Log updated successfully.');

        return redirect(route('call_logs.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  CallLog  $callLog
     *
     * @throws Exception
     *
     * @return JsonResponse
     **/
    public function destroy(CallLog $callLog)
    {
        $callLog->delete();

        return $this->sendSuccess('Call Log deleted successfully.');
    }

    /**
     * @return BinaryFileResponse
     */
    public function export()
    {
        return Excel::download(new CallLogExport, 'call-logs-'.time().'.xlsx');
    }
}
