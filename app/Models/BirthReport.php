<?php

namespace App\Models;

use App\Traits\PopulateTenantID;
use Eloquent as Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Stancl\Tenancy\Database\Concerns\BelongsToTenant;

/**
 * Class BirthReport
 *
 * @version February 18, 2020, 9:47 am UTC
 * @property int $id
 * @property int $patient_id
 * @property int $doctor_id
 * @property string $date
 * @property string|null $description
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Doctor $doctor
 * @property-read \App\Models\User $patient
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BirthReport newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BirthReport newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BirthReport query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BirthReport whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BirthReport whereDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BirthReport whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BirthReport whereDoctorId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BirthReport whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BirthReport wherePatientId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BirthReport whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property string $case_id
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BirthReport whereCaseId($value)
 * @property int $is_default
 * @property-read \App\Models\PatientCase $caseFromBirthReport
 * @method static \Illuminate\Database\Eloquent\Builder|BirthReport whereIsDefault($value)
 */
class BirthReport extends Model
{
    use BelongsToTenant, PopulateTenantID;

    /**
     * @var string
     */
    public $table = 'birth_reports';

    /**
     * @var array
     */
    public $fillable = [
        'patient_id',
        'case_id',
        'doctor_id',
        'date',
        'description',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id'        => 'integer',
        'case_id'   => 'string',
        'doctor_id' => 'integer',
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'case_id'     => 'required|unique:birth_reports,case_id',
        'doctor_id'   => 'required',
        'date'        => 'required',
        'description' => 'nullable',
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
    public function caseFromBirthReport()
    {
        return $this->belongsTo(PatientCase::class, 'case_id', 'case_id');
    }
}
