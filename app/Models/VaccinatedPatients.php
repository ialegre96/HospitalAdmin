<?php

namespace App\Models;

use App\Traits\PopulateTenantID;
use Eloquent as Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Stancl\Tenancy\Database\Concerns\BelongsToTenant;

/**
 * App\Models\VaccinatedPatients
 *
 * @property int $id
 * @property int $patient_id
 * @property int $vaccination_id
 * @property string|null $vaccination_serial_number
 * @property string $dose_number
 * @property \Illuminate\Support\Carbon $dose_given_date
 * @property string|null $description
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Patient $patient
 * @property-read \App\Models\Vaccination $vaccination
 * @method static \Illuminate\Database\Eloquent\Builder|VaccinatedPatients newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|VaccinatedPatients newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|VaccinatedPatients query()
 * @method static \Illuminate\Database\Eloquent\Builder|VaccinatedPatients whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VaccinatedPatients whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VaccinatedPatients whereDoseGivenDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VaccinatedPatients whereDoseNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VaccinatedPatients whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VaccinatedPatients wherePatientId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VaccinatedPatients whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VaccinatedPatients whereVaccinationId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VaccinatedPatients whereVaccinationSerialNumber($value)
 * @mixin Model
 */
class VaccinatedPatients extends Model
{
    use BelongsToTenant, PopulateTenantID;

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'patient_id'      => 'required',
        'vaccination_id'  => 'required',
        'dose_number'     => 'required|numeric|digits_between:1,50',
        'dose_given_date' => 'required',
    ];
    public $table = 'vaccinated_patients';
    public $fillable = [
        'patient_id',
        'vaccination_id',
        'vaccination_serial_number',
        'dose_number',
        'dose_given_date',
        'description',
    ];
    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id'                        => 'integer',
        'patient_id'                => 'integer',
        'vaccination_id'            => 'integer',
        'vaccination_serial_number' => 'string',
        'dose_number'               => 'string',
        'dose_given_date'           => 'datetime',
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
    public function vaccination()
    {
        return $this->belongsTo(Vaccination::class, 'vaccination_id');
    }
}
