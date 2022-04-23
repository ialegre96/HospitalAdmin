<?php

namespace App\Repositories;

use App\Models\Document;
use App\Models\DocumentType;
use App\Models\Patient;
use Auth;
use Carbon\Carbon;
use Symfony\Component\HttpKernel\Exception\UnprocessableEntityHttpException;

/**
 * Class DocumentRepository
 * @version February 18, 2020, 9:22 am UTC
 */
class DocumentRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'title',
        'document_type_id',
        'media_id',
        'patient_id',
    ];

    /**
     * Return searchable fields
     *
     * @return array
     */
    public function getFieldsSearchable()
    {
        return $this->fieldSearchable;
    }

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Document::class;
    }

    /**
     * @return mixed
     */
    public function getSyncList()
    {
        $user = Auth::user();
        if ($user->hasRole('Doctor')) {
            $data['patients'] = getPatientsList($user->owner_id);
        } else {
            if (! $user->hasRole('Patient')) {
                $data['patients'] = Patient::getActivePatientNames()->toArray();
            }
        }

        $data['documentType'] = DocumentType::select(['name', 'id'])->toBase()->pluck('name', 'id')->toArray();

        return $data;
    }

    /**
     * @param  array  $input
     */
    public function store($input)
    {
        try {
            $input['uploaded_by'] = Auth::id();
            /** @var Document $document */
            $document = $this->create($input);
            if (isset($input['file']) && ! empty($input['file'])) {
                $document->addMedia($input['file'])->toMediaCollection(Document::PATH, config('app.media_disc'));
            }
        } catch (\Exception $e) {
            throw new UnprocessableEntityHttpException($e->getMessage());
        }
    }

    /**
     * @param  array  $input
     * @param  int  $documentId
     */
    public function updateDocument($input, $documentId)
    {
        try {
            /** @var Document $document */
            $document = $this->update($input, $documentId);
            if (isset($input['file']) && ! empty($input['file'])) {
                if ($document->media->first()) {
                    $document->deleteMedia($document->media->first()->id);
                }
                $document->addMedia($input['file'])->toMediaCollection(Document::PATH, config('app.media_disc'));
                $document->update(['updated_at' => Carbon::now()->timestamp]);
            }
        } catch (\Exception $e) {
            throw new UnprocessableEntityHttpException($e->getMessage());
        }
    }

    /**
     * @param  int  $documentId
     */
    public function deleteDocument($documentId)
    {
        try {
            /** @var Document $document */
            $document = $this->find($documentId);
            if ($document->media->first()) {
                $document->deleteMedia($document->media->first()->id);
            }
            $this->delete($documentId);
        } catch (\Exception $e) {
            throw new UnprocessableEntityHttpException($e->getMessage());
        }
    }
}
