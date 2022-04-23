<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateDocumentRequest;
use App\Http\Requests\UpdateDocumentRequest;
use App\Models\Document;
use App\Models\User;
use App\Queries\DocumentDataTable;
use App\Repositories\DocumentRepository;
use DataTables;
use Exception;
use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Storage;
use Str;

class DocumentController extends AppBaseController
{
    /** @var DocumentRepository */
    private $documentRepository;

    public function __construct(DocumentRepository $documentRepo)
    {
        $this->documentRepository = $documentRepo;
    }

    /**
     * Display a listing of the Document.
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
            return DataTables::of((new DocumentDataTable())
                ->get())
                ->addColumn(User::IMG_COLUMN, function (Document $document) {
                    return $document->patient->user->image_url;
                })
                ->make(true);
        }

        $data = $this->documentRepository->getSyncList();

        return view('documents.index')->with($data);
    }

    /**
     * Store a newly created Document in storage.
     *
     * @param  CreateDocumentRequest  $request
     *
     * @return JsonResponse
     */
    public function store(CreateDocumentRequest $request)
    {
        $input = $request->all();

        $this->documentRepository->store($input);

        return $this->sendSuccess('Document saved successfully.');
    }

    /**
     * @param  Document  $document
     *
     * @return Application|Factory|View
     */
    public function show(Document $document)
    {
        $documents = $this->documentRepository->find($document->id);
        $data = $this->documentRepository->getSyncList();
        $data['documents'] = $documents;

        return view('documents.show')->with($data);
    }

    /**
     * Show the form for editing the specified Document.
     *
     * @param  Document  $document
     *
     * @return JsonResponse
     */
    public function edit(Document $document)
    {
        return $this->sendResponse($document, 'Document retrieved successfully.');
    }

    /**
     * Update the specified Document in storage.
     *
     * @param  Document  $document
     *
     * @param  UpdateDocumentRequest  $request
     *
     * @return JsonResponse
     */
    public function update(Document $document, UpdateDocumentRequest $request)
    {
        $this->documentRepository->updateDocument($request->all(), $document->id);

        return $this->sendSuccess('Document updated successfully.');
    }

    /**
     * Remove the specified Document from storage.
     *
     * @param  Document  $document
     * @throws Exception
     *
     * @return JsonResponse
     */
    public function destroy(Document $document)
    {
        $this->documentRepository->deleteDocument($document->id);

        return $this->sendSuccess('Document deleted successfully.');
    }

    /**
     * @param  Document  $document
     *
     * @throws FileNotFoundException
     *
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function downloadMedia(Document $document)
    {
        $documentMedia = $document->media[0];
        $documentPath = $documentMedia->getPath();
        if (config('app.media_disc') === 'public') {
            $documentPath = (Str::after($documentMedia->getUrl(), '/uploads'));
        }

        $file = Storage::disk(config('app.media_disc'))->get($documentPath);

        $headers = [
            'Content-Type'        => $document->media[0]->mime_type,
            'Content-Description' => 'File Transfer',
            'Content-Disposition' => "attachment; filename={$document->media[0]->file_name}",
            'filename'            => $document->media[0]->file_name,
        ];

        return response($file, 200, $headers);
    }
}
