<?php

namespace App\Models;

use App\Traits\PopulateTenantID;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Stancl\Tenancy\Database\Concerns\BelongsToTenant;

/**
 * App\Models\PatientDiagnosisTest
 *
 * @property int $id
 * @property int $patient_id
 * @property int $doctor_id
 * @property int $category_id
 * @property string $report_number
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\DiagnosisCategory $category
 * @property-read \App\Models\Doctor $doctor
 * @property-read \App\Models\Patient $patient
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PatientDiagnosisTest newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PatientDiagnosisTest newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PatientDiagnosisTest query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PatientDiagnosisTest whereCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PatientDiagnosisTest whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PatientDiagnosisTest whereDoctorId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PatientDiagnosisTest whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PatientDiagnosisTest wherePatientId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PatientDiagnosisTest whereReportNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PatientDiagnosisTest whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property-read Collection|PatientDiagnosisProperty[] $patientDiagnosisProperties
 * @property-read int|null $patient_diagnosis_properties_count
 */
class PatientDiagnosisTest extends Model
{
    use BelongsToTenant, PopulateTenantID;

    protected $table = 'patient_diagnosis_tests';

    public $fillable = [
        'patient_id',
        'doctor_id',
        'category_id',
        'report_number',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id'          => 'integer',
        'patient_id'  => 'integer',
        'doctor_id'   => 'integer',
        'category_id' => 'integer',
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'patient_id'  => 'required|unique:patient_diagnosis_tests,patient_id',
        'category_id' => 'required',
    ];

    /**
     * @var string[]
     */
    public static $messages = [
        'patient_id.unique' => 'The patient\'s name has already been taken.',
    ];

    /**
     * @return BelongsTo
     */
    public function patient()
    {
        return $this->belongsTo(Patient::class, 'patient_id');
    }

    /**
     * @return BelongsTo
     */
    public function doctor()
    {
        return $this->belongsTo(Doctor::class, 'doctor_id');
    }

    /**
     * @return BelongsTo
     */
    public function category()
    {
        return $this->belongsTo(DiagnosisCategory::class, 'category_id');
    }

    /**
     * @return HasMany
     */
    public function patientDiagnosisProperties()
    {
        return $this->hasMany(PatientDiagnosisProperty::class, 'patient_diagnosis_id');
    }
}
