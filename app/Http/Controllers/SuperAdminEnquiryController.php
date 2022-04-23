<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateSuperAdminEnquiryRequest;
use App\Models\SuperAdminEnquiry;
use App\Queries\SuperAdminEnquiryDataTable;
use App\Repositories\SuperAdminEnquiryRepository;
use DataTables;
use Exception;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SuperAdminEnquiryController extends AppBaseController
{
    /** @var SuperAdminEnquiryRepository */
    private $superAdminEnquiryRepository;

    public function __construct(SuperAdminEnquiryRepository $repo)
    {
        $this->superAdminEnquiryRepository = $repo;
    }

    /**
     * Display a listing of the resource.
     * @param  Request  $request
     * @throws Exception
     * @return Factory|View
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            return Datatables::of((new SuperAdminEnquiryDataTable())->get($request->only(['status'])))->make(true);
        }
        $data['statusArr'] = SuperAdminEnquiry::STATUS_ARR;

        return view('super_admin.enquiries.index', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CreateSuperAdminEnquiryRequest  $request
     *
     * @return JsonResponse
     */
    public function store(CreateSuperAdminEnquiryRequest $request)
    {
        $input = $request->all();
        $this->superAdminEnquiryRepository->store($input);

        return $this->sendSuccess('Enquiry send successfully.');
    }

    /**
     * Display the specified resource.
     * @param  SuperAdminEnquiry  $enquiry
     * @return Factory|View
     */
    public function show(SuperAdminEnquiry $enquiry)
    {
        if ($enquiry->status == SuperAdminEnquiry::UNREAD) {
            $enquiry->update(['status' => SuperAdminEnquiry::READ]);
        }

        return view('super_admin.enquiries.show', compact('enquiry'));
    }

    /**
     * Display the specified resource.
     * @param  SuperAdminEnquiry  $enquiry
     * @return JsonResponse
     */
    public function destroy(SuperAdminEnquiry $enquiry)
    {
        $enquiry->delete();

        return $this->sendSuccess('Enquiry deleted successfully.');
    }
}
