<?php

namespace App\Http\Controllers;

use App\Exports\PostalExport;
use App\Http\Requests\PostalRequest;
use App\Models\Postal;
use App\Queries\PostalDataTable;
use App\Repositories\PostalRepository;
use DataTables;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;
use Maatwebsite\Excel\Facades\Excel;
use Route;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

/**
 * Class PostalController
 */
class PostalController extends AppBaseController
{
    /**
     * @var postalRepository
     */
    private $postalRepository;

    /**
     * PostalController constructor.
     *
     * @param  PostalRepository  $postalRepository
     */
    public function __construct(PostalRepository $postalRepository)
    {
        $this->postalRepository = $postalRepository;
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
            return Datatables::of((new PostalDataTable())->get())->make(true);
        }
        if (Route::current()->getName() == 'receives.index') {
            return view('postals.receives.index');
        }
        if (Route::current()->getName() == 'dispatches.index') {
            return view('postals.dispatches.index');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  PostalRequest  $request
     *
     * @return JsonResponse
     */
    public function store(PostalRequest $request)
    {
        $input = $request->all();

        $this->postalRepository->store($input);

        if (Route::current()->getName() == 'receives.store') {
            return $this->sendSuccess('Postal Receive saved successfully.');
        }

        if (Route::current()->getName() == 'dispatches.store') {
            return $this->sendSuccess('Postal dispatch saved successfully.');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Postal  $postal
     *
     * @return JsonResponse
     */
    public function edit(Postal $postal)
    {
        if (Route::current()->getName() == 'receives.edit') {
            return $this->sendResponse($postal, 'Postal Receive retrieved successfully.');
        }

        if (Route::current()->getName() == 'dispatches.edit') {
            return $this->sendResponse($postal, 'Postal Dispatch retrieved successfully.');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  PostalRequest  $request
     *
     * @param  Postal  $postal
     *
     * @return JsonResponse
     */
    public function update(PostalRequest $request, Postal $postal)
    {
        $this->postalRepository->updatePostal($request->all(), $postal->id);

        if (Route::current()->getName() == 'receives.update') {
            return $this->sendSuccess('Postal Receive update successfully');
        }

        if (Route::current()->getName() == 'dispatches.update') {
            return $this->sendSuccess('Postal Dispatch update successfully');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Postal  $postal
     *
     * @return JsonResponse
     */
    public function destroy(Postal $postal)
    {
        $this->postalRepository->deleteDocument($postal->id);

        return $this->sendSuccess('Postal deleted successfully.');
    }

    /**
     * @param  Postal  $postal
     *
     * @return string
     */
    public function downloadMedia(Postal $postal)
    {
        list($file, $headers) = $this->postalRepository->downloadMedia($postal);

        return response($file, 200, $headers);
    }

    /**
     * @return BinaryFileResponse
     */
    public function export()
    {
        if (Route::current()->getName() == 'receives.excel') {
            return Excel::download(new PostalExport, 'receive-'.time().'.xlsx');
        }

        if (Route::current()->getName() == 'dispatches.excel') {
            return Excel::download(new PostalExport, 'dispatch-'.time().'.xlsx');
        }
    }
}
