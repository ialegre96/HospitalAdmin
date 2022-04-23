<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateEnquiryRequest;
use App\Models\Enquiry;
use App\Models\FrontSetting;
use App\Queries\EnquiryDataTable;
use App\Repositories\EnquiryRepository;
use DataTables;
use Exception;
use Flash;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\View\View;
use Route;

class EnquiryController extends AppBaseController
{
    /** @var EnquiryRepository */
    private $enquiryRepository;

    public function __construct(EnquiryRepository $enqRepo)
    {
        $this->enquiryRepository = $enqRepo;
    }

    /**
     * Display a listing of the resource.
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
            return Datatables::of((new EnquiryDataTable())->get($request->only(['status'])))->make(true);
        }
        $data['statusArr'] = Enquiry::STATUS_ARR;

        return view('enquiries.index', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CreateEnquiryRequest  $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(CreateEnquiryRequest $request)
    {
        $input = $request->all();
        $input['contact_no'] = preparePhoneNumber($input, 'contact_no');
        $input['tenant_id'] = getUser()->tenant_id;
        $this->enquiryRepository->store($input);

        return $this->sendSuccess('Enquiry send successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  Enquiry  $enquiry
     *
     * @return Factory|View
     */
    public function show(Enquiry $enquiry)
    {
        if ($enquiry->status == 0) {
            $enquiry->update(['viewed_by' => getLoggedInUserId()]);
            $enquiry->update(['status' => 1]);
        }

        return view('enquiries.show', compact('enquiry'));
    }

    /**
     * @param  int  $id
     *
     * @return JsonResponse
     */
    public function activeDeactiveStatus($id)
    {
        $enquiry = Enquiry::findOrFail($id);
        $status = ! $enquiry->status;
        $viewedStatus = ($status == 1) ? getLoggedInUserId() : null;
        $enquiry->update(['viewed_by' => $viewedStatus]);
        $enquiry->update(['status' => $status]);

        return $this->sendSuccess('Status updated successfully.');
    }

    /**
     * @return Application|Factory|View
     */
    public function contactUs()
    {
        return view('web.home.contact_us');
    }
}
