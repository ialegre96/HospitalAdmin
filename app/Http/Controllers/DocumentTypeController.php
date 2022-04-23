<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateDocumentTypeRequest;
use App\Http\Requests\UpdateDocumentTypeRequest;
use App\Models\Document;
use App\Models\DocumentType;
use App\Queries\DocumentTypeDataTable;
use App\Repositories\DocumentTypeRepository;
use Auth;
use DataTables;
use Exception;
use Flash;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\View\View;

class DocumentTypeController extends AppBaseController
{
    /** @var DocumentTypeRepository */
    private $documentTypeRepository;

    public function __construct(DocumentTypeRepository $documentTypeRepo)
    {
        $this->middleware('check_menu_access');
        $this->documentTypeRepository = $documentTypeRepo;
    }

    /**
     * Display a listing of the DocumentType.
     *
     * @param  Request  $request
     * @throws Exception
     *
     * @return Factory|View
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            return DataTables::of((new DocumentTypeDataTable())
                ->get())
                ->make(true);
        }

        return view('document_types.index');
    }

    /**
     * Store a newly created DocumentType in storage.
     *
     * @param  CreateDocumentTypeRequest  $request
     *
     * @return JsonResponse
     */
    public function store(CreateDocumentTypeRequest $request)
    {
        $input = $request->all();

        $this->documentTypeRepository->create($input);

        return $this->sendSuccess('Document Type saved successfully.');
    }

    /**
     * @param  int  $id
     *
     * @return Application|Factory|RedirectResponse|Redirector|View
     */
    public function show($id)
    {
        $documentType = DocumentType::find($id);
        if (empty($documentType)) {
            Flash::error('Document Type not found');

            return redirect(route('document-types.index'));
        }
        $documents = $documentType->documents;
        if (! getLoggedInUser()->hasRole('Admin')) {
            $documents = Document::whereUploadedBy(getLoggedInUser()->id)->whereDocumentTypeId($documentType->id)->get();
        }

        return view('document_types.show', compact('documentType', 'documents'));
    }

    /**
     * Show the form for editing the specified DocumentType.
     *
     * @param  DocumentType  $documentType
     *
     * @return JsonResponse
     */
    public function edit(DocumentType $documentType)
    {
        return $this->sendResponse($documentType, 'Document Type retrieved successfully.');
    }

    /**
     * Update the specified DocumentType in storage.
     *
     * @param  DocumentType  $documentType
     * @param  UpdateDocumentTypeRequest  $request
     *
     * @return JsonResponse
     */
    public function update(DocumentType $documentType, UpdateDocumentTypeRequest $request)
    {
        $this->documentTypeRepository->update($request->all(), $documentType->id);

        return $this->sendSuccess('Document Type updated successfully.');
    }

    /**
     * Remove the specified DocumentType from storage.
     *
     * @param  DocumentType  $documentType
     * @throws Exception
     *
     * @return JsonResponse
     */
    public function destroy(DocumentType $documentType)
    {
        $documentTypeModel = [
            Document::class,
        ];
        $result = canDelete($documentTypeModel, 'document_type_id', $documentType->id);
        if ($result) {
            return $this->sendError('Document Type can\'t be deleted.');
        }
        $this->documentTypeRepository->delete($documentType->id);

        return $this->sendSuccess('Document Type deleted successfully.');
    }
}
