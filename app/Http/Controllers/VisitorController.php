<?php

namespace App\Http\Controllers;

use App\Exports\VisitorExport;
use App\Http\Requests\CreateVisitorRequest;
use App\Http\Requests\UpdateVisitorRequest;
use App\Models\Visitor;
use App\Queries\VisitorDataTable;
use App\Repositories\VisitorRepository;
use DataTables;
use Exception;
use Flash;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
use Illuminate\View\View;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

/**
 * Class VisitorController
 */
class VisitorController extends AppBaseController
{
    /**
     * @var  visitorRepository
     */
    private $visitorRepository;

    /**
     * VisitorController constructor.
     *
     * @param  VisitorRepository  $visitorRepo
     */
    public function __construct(VisitorRepository $visitorRepo)
    {
        $this->visitorRepository = $visitorRepo;
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
            return Datatables::of((new VisitorDataTable())->get($request->only(['purpose'])))->make(true);
        }
        $purpose = Visitor::FILTER_PURPOSE;

        return view('visitors.index', compact('purpose'));
    }

    /**
     * @return Application|Factory|View
     */
    public function create()
    {
        $purpose = Visitor::PURPOSE;
        $isEdit = false;

        return view('visitors.create', compact('purpose', 'isEdit'));
    }

    /**
     * Store a newly created Visitor in storage.
     *
     * @param  CreateVisitorRequest  $request
     *
     * @return Application|RedirectResponse|Redirector
     */
    public function store(CreateVisitorRequest $request)
    {
        $input = $request->all();
        $input['phone'] = preparePhoneNumber($input, 'phone');
        $this->visitorRepository->store($input);
        Flash::success('Visitor saved successfully.');

        return redirect(route('visitors.index'));
    }

    /**
     * Show the form for editing the specified Visitor.
     *
     * @param  int  $id
     *
     * @return Application|Factory|View
     */
    public function edit($id)
    {
        $visitor = Visitor::findOrFail($id);
        $purpose = Visitor::PURPOSE;
        $fileExt = pathinfo($visitor->document_url, PATHINFO_EXTENSION);
        $isEdit = true;

        return view('visitors.edit', compact('visitor', 'purpose', 'fileExt', 'isEdit'));
    }

    /**
     * Update the specified Visitor in storage.
     *
     * @param  Visitor  $visitor
     *
     * @param  UpdateVisitorRequest  $request
     *
     * @return Application|RedirectResponse|Redirector
     */
    public function update(UpdateVisitorRequest $request, Visitor $visitor)
    {
        $input = $request->all();
        $input['phone'] = preparePhoneNumber($input, 'phone');
        $this->visitorRepository->updateVisitor($input, $visitor->id);
        Flash::success('Visitor updated successfully.');

        return redirect(route('visitors.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Visitor  $visitor
     *
     * @throws Exception
     *
     * @return JsonResponse
     **/
    public function destroy(Visitor $visitor)
    {
        $this->visitorRepository->deleteDocument($visitor->id);

        return $this->sendSuccess('Visitor deleted successfully.');
    }

    /**
     * @param  Visitor  $visitor
     *
     *
     * @return Application|\Illuminate\Contracts\Routing\ResponseFactory|Response
     */
    public function downloadMedia(Visitor $visitor)
    {
        list($file, $headers) = $this->visitorRepository->downloadMedia($visitor);

        return response($file, 200, $headers);
    }

    /**
     * @return BinaryFileResponse
     */
    public function export()
    {
        return Excel::download(new VisitorExport, 'visitor-'.time().'.xlsx');
    }
}
