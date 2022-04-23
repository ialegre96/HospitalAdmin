<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateFaqsRequest;
use App\Models\Faqs;
use App\Queries\FaqsDataTable;
use App\Repositories\FaqsRepository;
use DataTables;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class FaqsController extends AppBaseController
{
    /**
     * @var FaqsRepository
     */
    private $faqsRepo;

    /**
     * @param  FaqsRepository  $faqsRepository
     */
    public function __construct(FaqsRepository $faqsRepository)
    {
        $this->faqsRepo = $faqsRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @throws Exception
     *
     * @return Application|Factory|View|Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            return DataTables::of((new FaqsDataTable())->get())->make(true);
        }

        return view('landing.faqs.index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CreateFaqsRequest  $request
     *
     * @return JsonResponse
     */
    public function store(CreateFaqsRequest $request)
    {
        $input = $request->all();
        $this->faqsRepo->store($input);

        return $this->sendSuccess('FAQs created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param $id
     *
     * @return JsonResponse
     */
    public function show($id)
    {
        $faqs = Faqs::findOrFail($id);

        return $this->sendResponse($faqs, 'FAQs retrieved successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param $id
     *
     * @return JsonResponse
     */
    public function edit($id)
    {
        $faqs = Faqs::findOrFail($id);

        return $this->sendResponse($faqs, 'FAQs retrieved successfully.');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  CreateFaqsRequest  $request
     *
     * @param  Faqs  $faqs
     *
     * @return JsonResponse
     */
    public function update(CreateFaqsRequest $request, Faqs $faqs)
    {
        $input = $request->all();
        $this->faqsRepo->updateFaqs($input, $faqs);

        return $this->sendSuccess('FAQs updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $id
     *
     * @return JsonResponse
     */
    public function destroy($id)
    {
        $faqs = Faqs::findOrFail($id);
        $faqs->delete();

        return $this->sendSuccess('FAQs deleted successfully.');
    }
}
