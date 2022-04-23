<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateBedTypeRequest;
use App\Http\Requests\UpdateBedTypeRequest;
use App\Models\Bed;
use App\Models\BedType;
use App\Models\IpdPatientDepartment;
use App\Queries\BedTypeDataTable;
use App\Repositories\BedTypeRepository;
use DataTables;
use Exception;
use Flash;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

/**
 * Class BedTypeController
 */
class BedTypeController extends AppBaseController
{
    /** @var BedTypeRepository */
    private $bedTypeRepository;

    public function __construct(BedTypeRepository $bedTypeRepo)
    {
        $this->bedTypeRepository = $bedTypeRepo;
    }

    /**
     * Display a listing of the Bed_Type.
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
            return Datatables::of((new BedTypeDataTable())->get())->make(true);
        }

        return view('bed_types.index');
    }

    /**
     * Store a newly created Bed_Type in storage.
     *
     * @param  CreateBedTypeRequest  $request
     *
     * @return JsonResponse
     */
    public function store(CreateBedTypeRequest $request)
    {
        $input = $request->all();

        $bedType = $this->bedTypeRepository->create($input);

        return $this->sendSuccess('Bed Type saved successfully.');
    }

    /**
     * Display the specified Bed_Type.
     *
     * @param  int  $id
     *
     * @return Factory|View
     */
    public function show($id)
    {
        $bedType = BedType::find($id);
        if (empty($bedType)) {
            Flash::error('Bed Type not found');

            return redirect(route('bed-types.index'));
        }
        $beds = $bedType->beds;

        return view('bed_types.show', compact('bedType', 'beds'));
    }

    /**
     * Show the form for editing the specified Bed_Type.
     *
     * @param  BedType  $bedType
     *
     * @return JsonResponse
     */
    public function edit(BedType $bedType)
    {
        return $this->sendResponse($bedType, 'Bed Type retrieved successfully.');
    }

    /**
     * Update the specified Bed_Type in storage.
     *
     * @param  BedType  $bedType
     * @param  UpdateBedTypeRequest  $request
     *
     * @return JsonResponse
     */
    public function update(BedType $bedType, UpdateBedTypeRequest $request)
    {
        $input = $request->all();
        $bedType = $this->bedTypeRepository->update($input, $bedType->id);

        return $this->sendSuccess('Bed Type updated successfully.');
    }

    /**
     * Remove the specified Bed_Type from storage.
     *
     * @param  BedType  $bedType
     *
     * @throws Exception
     *
     * @return JsonResponse
     */
    public function destroy(BedType $bedType)
    {
        $bed = Bed::whereBedType($bedType->id)->exists();
        $ipdPatientDepartment = IpdPatientDepartment::whereBedTypeId($bedType->id)->exists();

        if ($bed || $ipdPatientDepartment) {
            return $this->sendError('Bed Type can\'t be deleted.');
        }

        $this->bedTypeRepository->delete($bedType->id);

        return $this->sendSuccess('Bed Type deleted successfully.');
    }
}
