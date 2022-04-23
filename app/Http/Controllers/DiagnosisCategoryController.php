<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateDiagnosisCategoryRequest;
use App\Http\Requests\UpdateDiagnosisCategoryRequest;
use App\Models\DiagnosisCategory;
use App\Models\PatientDiagnosisTest;
use App\Queries\DiagnosisCategoryDataTable;
use App\Repositories\DiagnosisCategoryRepository;
use DataTables;
use Exception;
use Flash;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DiagnosisCategoryController extends AppBaseController
{
    /**
     * @var DiagnosisCategoryRepository
     */
    private $categoryRepository;

    public function __construct(DiagnosisCategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @param  Request  $request
     *
     * @throws Exception
     *
     * @return Application|Factory|View
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            return DataTables::of((new DiagnosisCategoryDataTable())->get())->make(true);
        }

        return view('diagnosis_categories.index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CreateDiagnosisCategoryRequest  $request
     *
     * @return JsonResponse
     */
    public function store(CreateDiagnosisCategoryRequest $request)
    {
        $input = $request->all();
        $this->categoryRepository->create($input);

        return $this->sendSuccess('Diagnosis Category saved successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return Application|Factory|View
     */
    public function show($id)
    {
        $diagnosisCategory = DiagnosisCategory::find($id);
        if (empty($diagnosisCategory)) {
            Flash::error('Diagnosis Category not found');

            return redirect(route('diagnosis.category.index'));
        }

        return view('diagnosis_categories.show', compact('diagnosisCategory'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  DiagnosisCategory  $diagnosisCategory
     *
     * @return JsonResponse
     */
    public function edit(DiagnosisCategory $diagnosisCategory)
    {
        return $this->sendResponse($diagnosisCategory, 'Diagnosis Category retrieved successfully.');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UpdateDiagnosisCategoryRequest  $request
     *
     * @param  DiagnosisCategory  $diagnosisCategory
     *
     * @return JsonResponse
     */
    public function update(UpdateDiagnosisCategoryRequest $request, DiagnosisCategory $diagnosisCategory)
    {
        $input = $request->all();
        $this->categoryRepository->update($input, $diagnosisCategory->id);

        return $this->sendSuccess('Diagnosis Category updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  DiagnosisCategory  $diagnosisCategory
     *
     * @throws Exception
     *
     * @return JsonResponse
     */
    public function destroy(DiagnosisCategory $diagnosisCategory)
    {
        $diagnosisCategoryModal = [
            PatientDiagnosisTest::class,
        ];
        $result = canDelete($diagnosisCategoryModal, 'category_id', $diagnosisCategory->id);
        if ($result) {
            return $this->sendError('Diagnosis Category can\'t be deleted.');
        }

        $diagnosisCategory->delete();

        return $this->sendSuccess('Diagnosis Category deleted successfully.');
    }
}
