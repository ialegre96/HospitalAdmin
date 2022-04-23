<?php

namespace App\Http\Controllers\Landing;

use App\Http\Controllers\AppBaseController;
use App\Http\Requests\CreateAdminTestimonialRequest;
use App\Models\AdminTestimonial;
use App\Queries\SuperAdminTestimonialDataTable;
use App\Repositories\SuperAdminTestimonialRepository;
use DataTables;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class AdminTestimonialController extends AppBaseController
{
    /**
     * @var SuperAdminTestimonialRepository
     */
    private $adminTestimonialRepository;

    /**
     * TestimonialController constructor.
     *
     * @param  SuperAdminTestimonialRepository  $testimonialRepository
     */
    public function __construct(SuperAdminTestimonialRepository $testimonialRepository)
    {
        $this->adminTestimonialRepository = $testimonialRepository;
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
            return DataTables::of((new SuperAdminTestimonialDataTable())->get())->make(true);
        }

        return view('landing.testimonial.index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CreateAdminTestimonialRequest  $request
     *
     * @return JsonResponse
     */
    public function store(CreateAdminTestimonialRequest $request)
    {
        try {
            $input = $request->all();
            $this->adminTestimonialRepository->store($input);

            return $this->sendSuccess('Testimonial saved successfully.');
        } catch (Exception $e) {
            return $this->sendError($e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  AdminTestimonial  $adminTestimonial
     *
     * @return JsonResponse
     */
    public function show(AdminTestimonial $adminTestimonial)
    {
        return $this->sendResponse($adminTestimonial, 'Testimonial retrieved successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  AdminTestimonial  $adminTestimonial
     *
     * @return JsonResponse
     */
    public function edit(AdminTestimonial $adminTestimonial)
    {
        return $this->sendResponse($adminTestimonial, 'Testimonial retrieved successfully.');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  CreateAdminTestimonialRequest  $request
     *
     * @param $id
     *
     * @return JsonResponse
     */
    public function update(CreateAdminTestimonialRequest $request, $id)
    {
        try {
            $this->adminTestimonialRepository->updateTestimonial($request->all(), $id);

            return $this->sendSuccess('Testimonial updated successfully.');
        } catch (Exception $e) {
            return $this->sendError($e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  AdminTestimonial  $adminTestimonial
     *
     * @return JsonResponse
     */
    public function destroy(AdminTestimonial $adminTestimonial)
    {
        $adminTestimonial->delete();

        return $this->sendSuccess('Testimonial deleted successfully.');
    }
}
