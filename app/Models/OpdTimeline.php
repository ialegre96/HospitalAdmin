<?php

namespace App\Models;

use App\Traits\PopulateTenantID;
use Eloquent as Model;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Carbon;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Stancl\Tenancy\Database\Concerns\BelongsToTenant;

/**
 * App\Models\OpdTimeline
 *
 * @property-read mixed $opd_timeline_document_url
 * @property-read Collection|Media[] $media
 * @property-read int|null $media_count
 * @method static \Illuminate\Database\Eloquent\Builder|OpdTimeline newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|OpdTimeline newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|OpdTimeline query()
 * @mixin Model
 * @property int $id
 * @property int $opd_patient_department_id
 * @property string $title
 * @property string $date
 * @property string|null $description
 * @property bool $visible_to_person
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|OpdTimeline whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OpdTimeline whereDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OpdTimeline whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OpdTimeline whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OpdTimeline whereOpdPatientDepartmentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OpdTimeline whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OpdTimeline whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OpdTimeline whereVisibleToPerson($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OpdTimeline visible()
 */
class OpdTimeline extends Model implements HasMedia
{
    use InteractsWithMedia, BelongsToTenant, PopulateTenantID;

    public const OPD_TIMELINE_PATH = 'opd_timelines';
    public $table = 'opd_timelines';

    public $fillable = [
        'opd_patient_department_id',
        'title',
        'date',
        'description',
        'visible_to_person',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id'                        => 'integer',
        'opd_patient_department_id' => 'integer',
        'title'                     => 'string',
        'description'               => 'string',
        'visible_to_person'         => 'boolean',
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'title'      => 'required',
        'date'       => 'required',
        'attachment' => 'nullable|mimes:jpeg,png,pdf,docx,doc',
    ];

    /**
     * @var array
     */
    protected $appends = ['opd_timeline_document_url'];

    /**
     * @return mixed
     */
    public function getOpdTimelineDocumentUrlAttribute()
    {
        /** @var Media $media */
        $media = $this->media->first();
        if (! empty($media)) {
            return $media->getFullUrl();
        }

        return '';
    }

    /**
     * @param $query
     *
     *
     * @return mixed
     */
    public function scopeVisible($query)
    {
        return $query->where('visible_to_person', 1);
    }
}
