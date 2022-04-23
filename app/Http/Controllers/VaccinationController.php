<?php

namespace App\Http\Controllers;

use App\Exports\VaccinationExport;
use App\Http\Requests\CreateVaccinationRequest;
use App\Http\Requests\UpdateVaccinationRequest;
use App\Models\VaccinatedPatients;
use App\Models\Vaccination;
use App\Queries\VaccinationDataTable;
use App\Repositories\VaccinationRepository;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Yajra\DataTables\Facades\DataTables;

class VaccinationController extends AppBaseController
{
    /**
     * @var VaccinationRepository
     */
    private $vaccinationRepository;

    public function __construct(VaccinationRepository $vaccinationRepository)
    {
        $this->middleware('check_menu_access');
        $this->vaccinationRepository = $vaccinationRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @param  Request  $request
     *
     * @throws \Exception
     *
     * @return Application|Factory|Response|View
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            return Datatables::of((new VaccinationDataTable())->get())->make(true);
        }

        return view('vaccinations.index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CreateVaccinationRequest  $request
     *
     * @return JsonResponse
     */
    public function store(CreateVaccinationRequest $request)
    {
        try {
            $input = $request->all();
            $this->vaccinationRepository->create($input);

            return $this->sendSuccess('Vaccination saved successfully.');
        } catch (Exception $e) {
            return $this->sendError($e->getMessage());
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Vaccination  $vaccination
     *
     * @return JsonResponse
     */
    public function edit(Vaccination $vaccination)
    {
        return $this->sendResponse($vaccination, 'Vaccination retrieved successfully.');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UpdateVaccinationRequest  $request
     *
     * @param  Vaccination  $vaccination
     *
     * @return JsonResponse
     */
    public function update(UpdateVaccinationRequest $request, Vaccination $vaccination)
    {
        try {
            $input = $request->all();
            $this->vaccinationRepository->update($input, $vaccination->id);

            return $this->sendSuccess('Vaccination updated successfully.');
        } catch (Exception $e) {
            return $this->sendError($e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Vaccination  $vaccination
     *
     * @return JsonResponse
     */
    public function destroy(Vaccination $vaccination)
    {
        try {
            $vaccinatedModels = [
                VaccinatedPatients::class,
            ];
            
            $result = canDelete($vaccinatedModels, 'vaccination_id', $vaccination->id);
            
            if ($result) {
                return $this->sendError('Vaccination can\'t be deleted.');
            }
            
            $vaccination->delete();

            return $this->sendSuccess('Vaccination deleted successfully.');
        } catch (Exception $e) {
            return $this->sendError($e->getMessage());
        }
    }

    /**
     * @throws \PhpOffice\PhpSpreadsheet\Exception
     * @throws \PhpOffice\PhpSpreadsheet\Writer\Exception
     * @return BinaryFileResponse
     */
    public function vaccinationsExport()
    {
        return Excel::download(new VaccinationExport, 'vaccinations-'.time().'.xlsx');
    }
}
