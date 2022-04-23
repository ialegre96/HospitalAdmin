<?php

namespace App\Http\Controllers;

use App\Exports\PathologyTestExport;
use App\Http\Requests\CreatePathologyTestRequest;
use App\Http\Requests\UpdatePathologyTestRequest;
use App\Models\Charge;
use App\Models\PathologyTest;
use App\Queries\PathologyTestDataTable;
use App\Repositories\PathologyTestRepository;
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
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class PathologyTestController extends AppBaseController
{
    /** @var PathologyTestRepository */
    private $pathologyTestRepository;

    public function __construct(PathologyTestRepository $pathologyTestRepo)
    {
        $this->middleware('check_menu_access');
        $this->pathologyTestRepository = $pathologyTestRepo;
    }

    /**
     * Display a listing of the PathologyTest.
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
            return Datatables::of((new PathologyTestDataTable())->get())->make(true);
        }

        return view('pathology_tests.index');
    }

    /**
     * Show the form for creating a new PathologyTest.
     *
     * @return Factory|View
     */
    public function create()
    {
        $data = $this->pathologyTestRepository->getPathologyAssociatedData();

        return view('pathology_tests.create', compact('data'));
    }

    /**
     * Store a newly created PathologyTest in storage.
     *
     * @param  CreatePathologyTestRequest  $request
     *
     * @return RedirectResponse|Redirector
     */
    public function store(CreatePathologyTestRequest $request)
    {
        $input = $request->all();
        $input['standard_charge'] = removeCommaFromNumbers($input['standard_charge']);
        $input['unit'] = ! empty($input['unit']) ? $input['unit'] : null;
        $input['subcategory'] = ! empty($input['subcategory']) ? $input['subcategory'] : null;
        $input['method'] = ! empty($input['method']) ? $input['method'] : null;
        $input['report_days'] = ! empty($input['report_days']) ? $input['report_days'] : null;
        $this->pathologyTestRepository->create($input);
        Flash::success('Pathology Test saved successfully.');

        return redirect(route('pathology.test.index'));
    }

    /**
     * Display the specified PathologyTest.
     *
     * @param  int  $id
     *
     * @return Factory|View
     */
    public function show($id)
    {
        $pathologyTest = PathologyTest::findOrFail($id);

        return view('pathology_tests.show', compact('pathologyTest'));
    }

    /**
     * Show the form for editing the specified PathologyTest.
     *
     * @param  int  $id
     *
     * @return Factory|View
     */
    public function edit($id)
    {
        $pathologyTest = PathologyTest::findOrFail($id);
        $data = $this->pathologyTestRepository->getPathologyAssociatedData();

        return view('pathology_tests.edit', compact('pathologyTest', 'data'));
    }

    /**
     * Update the specified PathologyTest in storage.
     *
     * @param  PathologyTest  $pathologyTest
     * @param  UpdatePathologyTestRequest  $request
     *
     * @return RedirectResponse|Redirector
     */
    public function update(PathologyTest $pathologyTest, UpdatePathologyTestRequest $request)
    {
        $input = $request->all();
        $input['standard_charge'] = removeCommaFromNumbers($input['standard_charge']);
        $input['unit'] = ! empty($input['unit']) ? $input['unit'] : null;
        $input['subcategory'] = ! empty($input['subcategory']) ? $input['subcategory'] : null;
        $input['method'] = ! empty($input['method']) ? $input['method'] : null;
        $input['report_days'] = ! empty($input['report_days']) ? $input['report_days'] : null;
        $this->pathologyTestRepository->update($input, $pathologyTest->id);
        Flash::success('Pathology Test updated successfully.');

        return redirect(route('pathology.test.index'));
    }

    /**
     * Remove the specified PathologyTest from storage.
     *
     * @param  PathologyTest  $pathologyTest
     *
     * @throws Exception
     *
     * @return JsonResponse
     */
    public function destroy(PathologyTest $pathologyTest)
    {
        $pathologyTest->delete();

        return $this->sendSuccess('Pathology Test deleted successfully.');
    }

    /**
     * @param $id
     *
     * @return mixed
     */
    public function getStandardCharge($id)
    {
        $standardCharges = Charge::where('charge_category_id', $id)->value('standard_charge');

        return $this->sendResponse($standardCharges, 'StandardCharge retrieved successfully.');
    }

    /**
     * @return BinaryFileResponse
     */
    public function pathologyTestExport()
    {
        return Excel::download(new PathologyTestExport, 'pathology-tests-'.time().'.xlsx');
    }
    
    public function showModal(PathologyTest $pathologyTest)
    {
        $pathologyTest->load(['pathologycategory', 'chargecategory']);

        return $this->sendResponse($pathologyTest, 'Pathology Test Retrieved Successfully.');
    }
}
