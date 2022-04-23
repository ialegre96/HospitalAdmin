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
 * Class IpdTimeline
 *
 * @version September 12, 2020, 7:18 am UTC
 * @property int $ipd_patient_department_id
 * @property string $title
 * @property string $date
 * @property string $description
 * @property bool $visible_to_person
 * @property-read mixed $ipd_timeline_document_url
 * @property-read Collection|Media[] $media
 * @property-read int|null $media_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\IpdTimeline newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\IpdTimeline newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\IpdTimeline query()
 * @mixin \Eloquent
 * @property int $id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\IpdTimeline whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\IpdTimeline whereDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\IpdTimeline whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\IpdTimeline whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\IpdTimeline whereIpdPatientDepartmentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\IpdTimeline whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\IpdTimeline whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\IpdTimeline whereVisibleToPerson($value)
 * @method static \Illuminate\Database\Eloquent\Builder|IpdTimeline visible()
 */
class IpdTimeline extends Model implements HasMedia
{
    use BelongsToTenant, PopulateTenantID, InteractsWithMedia;

    public const IPD_TIMELINE_PATH = 'ipd_timelines';
    public $table = 'ipd_timelines';

    public $fillable = [
        'ipd_patient_department_id',
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
        'ipd_patient_department_id' => 'integer',
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
    protected $appends = ['ipd_timeline_document_url'];

    /**
     * @return mixed
     */
    public function getIpdTimelineDocumentUrlAttribute()
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
