<?php

namespace App\Models;

use App\Traits\PopulateTenantID;
use Eloquent as Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Stancl\Tenancy\Database\Concerns\BelongsToTenant;

/**
 * Class DeathReport
 *
 * @version February 18, 2020, 11:10 am UTC
 * @property int $id
 * @property int $patient_id
 * @property int $doctor_id
 * @property string $date
 * @property string|null $description
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Doctor $doctor
 * @property-read \App\Models\User $patient
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DeathReport newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DeathReport newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DeathReport query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DeathReport whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DeathReport whereDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DeathReport whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DeathReport whereDoctorId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DeathReport whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DeathReport wherePatientId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DeathReport whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property string $case_id
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DeathReport whereCaseId($value)
 * @property int $is_default
 * @property-read \App\Models\PatientCase $caseFromDeathReport
 * @method static \Illuminate\Database\Eloquent\Builder|DeathReport whereIsDefault($value)
 */
class DeathReport extends Model
{
    use BelongsToTenant, PopulateTenantID;

    /**
     * @var string
     */
    public $table = 'death_reports';

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
        'case_id'     => 'required|unique:death_reports,case_id',
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
    public function caseFromDeathReport()
    {
        return $this->belongsTo(PatientCase::class, 'case_id', 'case_id');
    }
}
