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
 * Class IpdDiagnosis
 *
 * @version September 8, 2020, 11:46 am UTC
 * @property int $ipd_patient_department_id
 * @property string $report_type
 * @property string $report_date
 * @property string $description
 * @property int $id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\IpdDiagnosis newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\IpdDiagnosis newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\IpdDiagnosis query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\IpdDiagnosis whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\IpdDiagnosis whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\IpdDiagnosis whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\IpdDiagnosis whereIpdPatientDepartmentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\IpdDiagnosis whereReportDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\IpdDiagnosis whereReportType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\IpdDiagnosis whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property-read mixed $document_url
 * @property-read Collection|Media[] $media
 * @property-read int|null $media_count
 * @property-read mixed $ipd_diagnosis_document_url
 */
class IpdDiagnosis extends Model implements HasMedia
{
    use InteractsWithMedia, BelongsToTenant, PopulateTenantID;

    public const IPD_DIAGNOSIS_PATH = 'ipd_diagnosis';
    public $table = 'ipd_diagnoses';

    public $fillable = [
        'ipd_patient_department_id',
        'report_type',
        'report_date',
        'description',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id'                        => 'integer',
        'ipd_patient_department_id' => 'integer',
        'report_type'               => 'string',
        'description'               => 'string',
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'report_type' => 'required',
        'report_date' => 'required',
        'file'        => 'nullable|mimes:jpeg,png,pdf,docx,doc',
    ];

    /**
     * @var array
     */
    protected $appends = ['ipd_diagnosis_document_url'];

    /**
     * @return mixed
     */
    public function getIpdDiagnosisDocumentUrlAttribute()
    {
        /** @var Media $media */
        $media = $this->media->first();
        if (! empty($media)) {
            return $media->getFullUrl();
        }

        return '';
    }
}
