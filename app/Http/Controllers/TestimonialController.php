<?php

namespace App\Http\Controllers;

use App\Http\Requests\TestimonialRequest;
use App\Models\Testimonial;
use App\Queries\TestimonialDatatable;
use App\Repositories\TestimonialRepository;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;
use Yajra\DataTables\DataTables;

/**
 * Class TestimonialController
 */
class TestimonialController extends AppBaseController
{
    /**
     * @var testimonialRepository
     */
    private $testimonialRepository;

    /**
     * TestimonialController constructor.
     *
     * @param  TestimonialRepository  $testimonialRepository
     */
    public function __construct(TestimonialRepository $testimonialRepository)
    {
        $this->testimonialRepository = $testimonialRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @param  Request  $request
     *
     * @throws Exception
     *
     * @return Application|Factory|View|Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            return Datatables::of((new TestimonialDataTable())->get())->make(true);
        }

        return view('testimonials.index');
    }

    /**
     * Store a newly created Testimonial in storage.
     *
     * @param  TestimonialRequest  $request
     *
     * @return JsonResponse
     */
    public function store(TestimonialRequest $request)
    {
        try {
            $input = $request->all();
            $this->testimonialRepository->store($input);

            return $this->sendSuccess('Testimonial saved successfully.');
        } catch (Exception $e) {
            return $this->sendError($e->getMessage());
        }
    }

    /**
     * Show the form for editing the specified Testimonial.
     *
     * @param  Testimonial  $testimonial
     *
     * @return JsonResponse
     */
    public function edit(Testimonial $testimonial)
    {
        return $this->sendResponse($testimonial, 'Testimonial retrieved successfully.');
    }

    /**
     * @param  Testimonial  $testimonial
     *
     * @param  TestimonialRequest  $request
     *
     * @return JsonResponse
     */
    public function update(Testimonial $testimonial, TestimonialRequest $request)
    {
        try {
            $this->testimonialRepository->updateTestimonial($request->all(), $testimonial->id);

            return $this->sendSuccess('Testimonial updated successfully.');
        } catch (Exception $e) {
            return $this->sendError($e->getMessage());
        }
    }

    /**
     * Remove the specified Testimonial from storage.
     *
     * @param  Testimonial  $testimonial
     *
     * @throws Exception
     *
     * @return JsonResponse
     */
    public function destroy(Testimonial $testimonial)
    {
        try {
            $this->testimonialRepository->deleteTestimonial($testimonial);

            return $this->sendSuccess('Testimonial deleted successfully.');
        } catch (Exception $e) {
            return $this->sendError($e->getMessage());
        }
    }
}
