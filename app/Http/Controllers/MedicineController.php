<?php

namespace App\Http\Controllers;

use App\Exports\MedicineExport;
use App\Http\Requests\CreateMedicineRequest;
use App\Http\Requests\UpdateMedicineRequest;
use App\Models\Medicine;
use App\Queries\MedicinesDataTable;
use App\Repositories\MedicineRepository;
use DataTables;
use Exception;
use Flash;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\View\View;
use Maatwebsite\Excel\Facades\Excel;
use Response;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class MedicineController extends AppBaseController
{
    /** @var MedicineRepository */
    private $medicineRepository;

    public function __construct(MedicineRepository $medicineRepo)
    {
        $this->medicineRepository = $medicineRepo;
    }

    /**
     * Display a listing of the Medicine.
     *
     * @param  Request  $request
     *
     * @throws Exception
     *
     * @return Factory|View|Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            return Datatables::of((new MedicinesDataTable())->get())->make(true);
        }

        return view('medicines.index');
    }

    /**
     * Show the form for creating a new Medicine.
     *
     * @return Factory|View
     */
    public function create()
    {
        $data = $this->medicineRepository->getSyncList();

        return view('medicines.create')->with($data);
    }

    /**
     * Store a newly created Medicine in storage.
     *
     * @param  CreateMedicineRequest  $request
     *
     * @return RedirectResponse|Redirector
     */
    public function store(CreateMedicineRequest $request)
    {
        $input = $request->all();

        $this->medicineRepository->create($input);

        Flash::success('Medicine saved successfully.');

        return redirect(route('medicines.index'));
    }

    /**
     * Display the specified Medicine.
     * @param  Medicine  $medicine
     *
     * @return Factory|View
     */
    public function show(Medicine $medicine)
    {
        $medicine->brand;
        $medicine->category;

        return view('medicines.show')->with('medicine', $medicine);
    }

    /**
     * Show the form for editing the specified Medicine.
     *
     * @param  int  $id
     *
     * @return Factory|View
     */
    public function edit($id)
    {
        $medicine = Medicine::findOrFail($id);
        $data = $this->medicineRepository->getSyncList();
        $data['medicine'] = $medicine;

        return view('medicines.edit')->with($data);
    }

    /**
     * Update the specified Medicine in storage.
     *
     * @param  Medicine  $medicine
     * @param  UpdateMedicineRequest  $request
     *
     * @return RedirectResponse|Redirector
     */
    public function update(Medicine $medicine, UpdateMedicineRequest $request)
    {
        $this->medicineRepository->update($request->all(), $medicine->id);

        Flash::success('Medicine updated successfully.');

        return redirect(route('medicines.index'));
    }

    /**
     * Remove the specified Medicine from storage.
     *
     * @param  Medicine  $medicine
     * @throws Exception
     *
     * @return JsonResponse
     */
    public function destroy(Medicine $medicine)
    {
        $this->medicineRepository->delete($medicine->id);

        return $this->sendSuccess('Medicine deleted successfully.');
    }

    /**
     * @return BinaryFileResponse
     */
    public function medicineExport()
    {
        return Excel::download(new MedicineExport, 'medicines-'.time().'.xlsx');
    }

    /**
     * @param  Medicine  $medicine
     *
     * @return JsonResponse
     */
    public function showModal(Medicine $medicine)
    {
        $medicine->load(['brand', 'category']);
        
        return $this->sendResponse($medicine, 'Medicine Retrieved Successfully');
    }
}
