<?php

namespace App\Models;

use App\Traits\PopulateTenantID;
use Eloquent as Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Support\Carbon;
use Stancl\Tenancy\Database\Concerns\BelongsToTenant;

/**
 * Class EmployeePayroll
 *
 * @version February 19, 2020, 8:03 am UTC
 * @property int $id
 * @property int $sr_no
 * @property string $payroll_id
 * @property string $type
 * @property int $owner_id
 * @property string $owner_type
 * @property string $month
 * @property int $year
 * @property float $net_salary
 * @property int $status
 * @property float $basic_salary
 * @property float $allowance
 * @property float $deductions
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static Builder|EmployeePayroll newModelQuery()
 * @method static Builder|EmployeePayroll newQuery()
 * @method static Builder|EmployeePayroll query()
 * @method static Builder|EmployeePayroll whereAllowance($value)
 * @method static Builder|EmployeePayroll whereBasicSalary($value)
 * @method static Builder|EmployeePayroll whereCreatedAt($value)
 * @method static Builder|EmployeePayroll whereDeductions($value)
 * @method static Builder|EmployeePayroll whereId($value)
 * @method static Builder|EmployeePayroll whereMonth($value)
 * @method static Builder|EmployeePayroll whereNetSalary($value)
 * @method static Builder|EmployeePayroll whereOwnerId($value)
 * @method static Builder|EmployeePayroll whereOwnerType($value)
 * @method static Builder|EmployeePayroll wherePayrollId($value)
 * @method static Builder|EmployeePayroll whereSrNo($value)
 * @method static Builder|EmployeePayroll whereStatus($value)
 * @method static Builder|EmployeePayroll whereUpdatedAt($value)
 * @method static Builder|EmployeePayroll whereYear($value)
 * @mixin Model
 * @method static Builder|EmployeePayroll whereType($value)
 * @property-read Nurse $nurse
 * @property-read EmployeePayroll $owner
 * @property int $is_default
 * @property-read mixed $type_string
 * @method static Builder|EmployeePayroll whereIsDefault($value)
 */
class EmployeePayroll extends Model
{
    use BelongsToTenant, PopulateTenantID;

    const STATUS_ALL = 2;
    const PAID = 1;
    const NOT_PAID = 0;
    const STATUS = [0 => 'Unpaid', 1 => 'Paid'];
    const MONTHS = [
        1  => 'January',
        2  => 'February',
        3  => 'March',
        4  => 'April',
        5  => 'May',
        6  => 'June',
        7  => 'July',
        8  => 'August',
        9  => 'September',
        10 => 'October',
        11 => 'November',
        12 => 'December',
    ];

    const TYPES = [
        6 => 'Accountant',
        7 => 'Case Manager',
        2 => 'Doctor',
        3 => 'Lab Technician',
        1 => 'Nurse',
        5 => 'Pharmacist',
        4 => 'Receptionist',
    ];

    const CLASS_TYPES = [
        1 => Nurse::class,
        2 => Doctor::class,
        3 => LabTechnician::class,
        4 => Receptionist::class,
        5 => Pharmacist::class,
        6 => Accountant::class,
        7 => CaseHandler::class,
    ];

    const STATUS_ARR = [
        self::STATUS_ALL => 'All',
        self::PAID       => 'Paid',
        self::NOT_PAID   => 'Unpaid',
    ];

    public $table = 'employee_payrolls';

    protected $appends = ['type_string'];

    public $fillable = [
        'sr_no',
        'payroll_id',
        'type',
        'owner_id',
        'owner_type',
        'month',
        'year',
        'net_salary',
        'status',
        'basic_salary',
        'allowance',
        'deductions',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id'           => 'integer',
        'sr_no'        => 'integer',
        'payroll_id'   => 'string',
        'type'         => 'integer',
        'owner_id'     => 'integer',
        'owner_type'   => 'string',
        'month'        => 'string',
        'year'         => 'integer',
        'net_salary'   => 'double',
        'status'       => 'int',
        'basic_salary' => 'double',
        'allowance'    => 'double',
        'deductions'   => 'double',
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'sr_no'        => 'required|numeric',
        'payroll_id'   => 'required',
        'type'         => 'required|numeric',
        'owner_id'     => 'required',
        'month'        => 'required',
        'year'         => 'required',
        'net_salary'   => 'required',
        'basic_salary' => 'required',
    ];

    /**
     * @return MorphTo
     */
    public function owner()
    {
        return $this->morphTo();
    }

    /**
     * @return mixed
     */
    public function getTypeStringAttribute()
    {
        return self::TYPES[$this->type];
    }
}
