<?php

namespace App\Models;

use App\Traits\PopulateTenantID;
use Eloquent as Model;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Carbon;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Stancl\Tenancy\Database\Concerns\BelongsToTenant;

/**
 * App\Models\Document
 *
 * @property int $id
 * @property string $title
 * @property int $document_type_id
 * @property int $patient_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property Carbon|null $deleted_at
 * @property-read Collection|Media[] $media
 * @property-read int|null $media_count
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Eloquent\Builder|Document newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Document newQuery()
 * @method static Builder|Document onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Document query()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|Document whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Document whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Document whereDocumentTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Document whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Document whereMediaId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Document wherePatientId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Document whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Document whereUpdatedAt($value)
 * @method static Builder|Document withTrashed()
 * @method static Builder|Document withoutTrashed()
 * @mixin Model
 * @property-read \App\Models\DocumentType $documentType
 * @property-read mixed $document_url
 * @property-read \App\Models\Patient $patient
 * @property int $uploaded_by
 * @property string|null $notes
 * @property int $is_default
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|Document whereIsDefault($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Document whereNotes($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Document whereUploadedBy($value)
 */
class Document extends Model implements HasMedia
{
    use BelongsToTenant, PopulateTenantID, InteractsWithMedia;

    public $table = 'documents';
    public const PATH = 'documents';

    public $fillable = [
        'title',
        'document_type_id',
        'patient_id',
        'uploaded_by',
        'notes',
        'updated_at',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id'               => 'integer',
        'title'            => 'string',
        'document_type_id' => 'integer',
        'patient_id'       => 'integer',
        'notes'            => 'string',
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'title'            => 'required|string',
        'document_type_id' => 'required|integer',
        'patient_id'       => 'required|integer',
    ];

    /**
     * @var array
     */
    protected $appends = ['document_url'];

    /**
     * @return mixed
     */
    public function getDocumentUrlAttribute()
    {
        /** @var Media $media */
        $media = $this->media->first();
        if (! empty($media)) {
            return $media->getFullUrl();
        }

        return '';
    }

    /**
     * @return BelongsTo
     */
    public function documentType()
    {
        return $this->belongsTo(DocumentType::class, 'document_type_id');
    }

    /**
     * @return BelongsTo
     */
    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

    /**
     * @return BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'uploaded_by');
    }
}
