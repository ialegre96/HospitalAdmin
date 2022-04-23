<?php

namespace App\Models;

use App\Traits\PopulateTenantID;
use Illuminate\Database\Eloquent\Model;
use Stancl\Tenancy\Database\Concerns\BelongsToTenant;

/**
 * App\Models\Ambulance
 *
 * @property int $id
 * @property string $vehicle_number
 * @property string $vehicle_model
 * @property string $year_made
 * @property string $driver_name
 * @property string $driver_license
 * @property string $driver_contact
 * @property string|null $note
 * @property bool $is_available
 * @property int $vehicle_type
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Ambulance newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Ambulance newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Ambulance query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Ambulance whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Ambulance whereDriverContact($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Ambulance whereDriverLicense($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Ambulance whereDriverName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Ambulance whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Ambulance whereIsAvailable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Ambulance whereNote($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Ambulance whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Ambulance whereVehicleModel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Ambulance whereVehicleNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Ambulance whereVehicleType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Ambulance whereYearMade($value)
 * @mixin \Eloquent
 * @property int $is_default
 * @method static \Illuminate\Database\Eloquent\Builder|Ambulance whereIsDefault($value)
 */
class Ambulance extends Model
{
    use BelongsToTenant, PopulateTenantID;

    const STATUS_ALL = 2;
    const TRUE = 1;
    const FALSE = 0;
    const STATUS_ARR = [
        self::STATUS_ALL => 'All',
        self::TRUE       => 'Available',
        self::FALSE      => 'Not Available',
    ];
    public static $vehicleType = [
        1 => 'Owned',
        2 => 'Contractual',
    ];
    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'vehicle_number' => 'required|is_unique:ambulances,vehicle_number',
        'vehicle_model'  => 'required',
        'driver_contact' => 'nullable|numeric',
        'year_made'      => 'required|size:4',
    ];
    public $table = 'ambulances';
    public $fillable = [
        'vehicle_number',
        'vehicle_model',
        'year_made',
        'driver_name',
        'driver_license',
        'driver_contact',
        'is_available',
        'note',
        'vehicle_type',
    ];
    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id'             => 'integer',
        'vehicle_number' => 'string',
        'vehicle_model'  => 'string',
        'year_made'      => 'string',
        'driver_name'    => 'string',
        'driver_license' => 'string',
        'driver_contact' => 'string',
        'note'           => 'string',
        'vehicle_type'   => 'integer',
        'is_available'   => 'boolean',
    ];
}
