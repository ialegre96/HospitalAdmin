<?php

namespace App\Models;

use App\Traits\PopulateTenantID;
use Eloquent;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;
use Stancl\Tenancy\Database\Concerns\BelongsToTenant;

/**
 * App\Models\BloodIssue
 *
 * @property int $id
 * @property string $issue_date
 * @property int $doctor_id
 * @property int $donor_id
 * @property int $patient_id
 * @property string|null $amount
 * @property string|null $remarks
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read BloodDonor $bloodDonor
 * @property-read Doctor $doctor
 * @property-read Patient $patient
 * @method static \Illuminate\Database\Eloquent\Builder|BloodIssue newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|BloodIssue newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|BloodIssue query()
 * @method static \Illuminate\Database\Eloquent\Builder|BloodIssue whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BloodIssue whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BloodIssue whereDoctorId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BloodIssue whereDonorId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BloodIssue whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BloodIssue whereIssueDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BloodIssue wherePatientId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BloodIssue whereRemarks($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BloodIssue whereUpdatedAt($value)
 * @mixin Eloquent
 * @property-read \App\Models\BloodDonor $blooddonor
 */
class BloodIssue extends Model
{
    use BelongsToTenant, PopulateTenantID;

    public $table = 'blood_issues';

    public $fillable = [
        'issue_date',
        'doctor_id',
        'patient_id',
        'donor_id',
        'amount',
        'remarks',
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'issue_date' => 'required',
        'patient_id' => 'required',
        'doctor_id'  => 'required',
        'donor_id'   => 'required',
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
    public function blooddonor()
    {
        return $this->belongsTo(BloodDonor::class, 'donor_id');
    }
}
