<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateIpdPaymentRequest;
use App\Http\Requests\UpdateIpdPaymentRequest;
use App\Models\IpdPayment;
use App\Queries\IpdPaymentDataTable;
use App\Repositories\IpdPaymentRepository;
use DataTables;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Response;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class IpdPaymentController extends AppBaseController
{
    /** @var IpdPaymentRepository */
    private $ipdPaymentRepository;

    public function __construct(IpdPaymentRepository $ipdPaymentRepo)
    {
        $this->ipdPaymentRepository = $ipdPaymentRepo;
    }

    /**
     * Display a listing of the IpdPayment.
     *
     * @param  Request  $request
     *
     * @throws Exception
     *
     * @return Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            return DataTables::of((new IpdPaymentDataTable())->get($request->id))->make(true);
        }
    }

    /**
     * Store a newly created IpdPayment in storage.
     *
     * @param  CreateIpdPaymentRequest  $request
     *
     * @return JsonResponse
     */
    public function store(CreateIpdPaymentRequest $request)
    {
        $input = $request->all();

        $this->ipdPaymentRepository->store($input);

        return $this->sendSuccess('IPD Payment saved successfully.');
    }

    /**
     * Show the form for editing the specified Ipd Payment.
     *
     * @param  IpdPayment  $ipdPayment
     *
     * @return JsonResponse
     */
    public function edit(IpdPayment $ipdPayment)
    {
        return $this->sendResponse($ipdPayment, 'IPD Payment retrieved successfully.');
    }

    /**
     * Update the specified Ipd Payment in storage.
     *
     * @param  IpdPayment  $ipdPayment
     *
     * @param  UpdateIpdPaymentRequest  $request
     *
     * @return JsonResponse
     */
    public function update(IpdPayment $ipdPayment, UpdateIpdPaymentRequest $request)
    {
        $this->ipdPaymentRepository->updateIpdPayment($request->all(), $ipdPayment->id);

        return $this->sendSuccess('IPD Payment updated successfully.');
    }

    /**
     * Remove the specified IpdPayment from storage.
     *
     * @param  IpdPayment  $ipdPayment
     *
     * @throws Exception
     *
     * @return JsonResponse
     */
    public function destroy(IpdPayment $ipdPayment)
    {
        $this->ipdPaymentRepository->deleteIpdPayment($ipdPayment->id);

        return $this->sendSuccess('IPD Payment deleted successfully.');
    }

    /**
     * @param  IpdPayment  $ipdPayment
     *
     * @return Media
     */
    public function downloadMedia(IpdPayment $ipdPayment)
    {
        $media = $ipdPayment->getMedia(IpdPayment::IPD_PAYMENT_PATH)->first();
        if ($media != null) {
            $media = $media->id;
            $mediaItem = Media::findOrFail($media);

            return $mediaItem;
        }

        return '';
    }
}
