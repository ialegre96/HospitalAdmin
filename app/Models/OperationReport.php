<?php

namespace App\Models;

use App\Traits\PopulateTenantID;
use Eloquent as Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;
use Stancl\Tenancy\Database\Concerns\BelongsToTenant;

/**
 * Class OperationReport
 *
 * @version February 18, 2020, 6:02 am UTC
 * @property int $doctor_id
 * @property Carbon $date
 * @property string $description
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OperationReport newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OperationReport newQuery()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\OperationReport onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OperationReport query()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OperationReport whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OperationReport whereDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OperationReport whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OperationReport whereDoctorId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OperationReport whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OperationReport whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\OperationReport withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\OperationReport withoutTrashed()
 * @mixin Model
 * @property int $id
 * @property int $patient_id
 * @property string $case_id
 * @property-read \App\Models\Doctor $doctor
 * @property-read \App\Models\Patient $patient
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OperationReport whereCaseId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OperationReport wherePatientId($value)
 * @property int $is_default
 * @property-read \App\Models\PatientCase $caseFromOperationReport
 * @method static \Illuminate\Database\Eloquent\Builder|OperationReport whereIsDefault($value)
 */
class OperationReport extends Model
{
    use BelongsToTenant, PopulateTenantID;

    public $table = 'operation_reports';

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
        'id'          => 'integer',
        'patient_id'  => 'integer',
        'case_id'     => 'string',
        'doctor_id'   => 'integer',
        'description' => 'string',
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'case_id'   => 'required|unique:operation_reports,case_id',
        'doctor_id' => 'required',
        'date'      => 'required|date',
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
    public function caseFromOperationReport()
    {
        return $this->belongsTo(PatientCase::class, 'case_id', 'case_id');
    }
}
