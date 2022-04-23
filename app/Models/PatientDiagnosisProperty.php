<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * App\Models\PatientDiagnosisProperty
 *
 * @property int $id
 * @property int $patient_diagnosis_id
 * @property string $property_name
 * @property string $property_value
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\PatientDiagnosisTest $reportNumber
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PatientDiagnosisProperty newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PatientDiagnosisProperty newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PatientDiagnosisProperty query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PatientDiagnosisProperty whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PatientDiagnosisProperty whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PatientDiagnosisProperty
 *     wherePatientDiagnosisId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PatientDiagnosisProperty wherePropertyName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PatientDiagnosisProperty wherePropertyValue($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PatientDiagnosisProperty whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class PatientDiagnosisProperty extends Model
{
    protected $table = 'patient_diagnosis_properties';

    /**
     * @var array
     */
    public $fillable = [
        'patient_diagnosis_id',
        'property_name',
        'property_value',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id'                   => 'integer',
        'patient_diagnosis_id' => 'integer',
        'property_name'        => 'string',
        'property_value'       => 'string',
    ];

    /**
     * @return BelongsTo
     */
    public function reportNumber()
    {
        return $this->belongsTo(PatientDiagnosisTest::class, 'patient_diagnosis_id');
    }
}
