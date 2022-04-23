<?php

namespace App\Models;

use App\Traits\PopulateTenantID;
use Illuminate\Database\Eloquent\Model;
use Stancl\Tenancy\Database\Concerns\BelongsToTenant;

/**
 * App\Models\IpdBill
 *
 * @property int $id
 * @property int $ipd_patient_department_id
 * @property int $total_charges
 * @property int $total_payments
 * @property int $gross_total
 * @property int $discount_in_percentage
 * @property int $tax_in_percentage
 * @property int $other_charges
 * @property int $net_payable_amount
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\IpdPatientDepartment $ipdPatient
 * @method static \Illuminate\Database\Eloquent\Builder|IpdBill newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|IpdBill newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|IpdBill query()
 * @method static \Illuminate\Database\Eloquent\Builder|IpdBill whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|IpdBill whereDiscountInPercentage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|IpdBill whereGrossTotal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|IpdBill whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|IpdBill whereIpdPatientDepartmentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|IpdBill whereNetPayableAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|IpdBill whereOtherCharges($value)
 * @method static \Illuminate\Database\Eloquent\Builder|IpdBill whereTaxInPercentage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|IpdBill whereTotalCharges($value)
 * @method static \Illuminate\Database\Eloquent\Builder|IpdBill whereTotalPayments($value)
 * @method static \Illuminate\Database\Eloquent\Builder|IpdBill whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class IpdBill extends Model
{
    use BelongsToTenant, PopulateTenantID;

    public $table = 'ipd_bills';

    public $fillable = [
        'ipd_patient_department_id',
        'total_charges',
        'total_payments',
        'gross_total',
        'discount_in_percentage',
        'tax_in_percentage',
        'other_charges',
        'net_payable_amount',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id'                        => 'integer',
        'ipd_patient_department_id' => 'integer',
        'total_charges'             => 'integer',
        'total_payments'            => 'integer',
        'gross_total'               => 'integer',
        'discount_in_percentage'    => 'integer',
        'tax_in_percentage'         => 'integer',
        'other_charges'             => 'integer',
        'net_payable_amount'        => 'integer',
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'ipd_patient_department_id' => 'required',
        'total_payments'            => 'required',
        'gross_total'               => 'required',
        'discount_in_percentage'    => 'required',
        'tax_in_percentage'         => 'required',
        'other_charges'             => 'required',
        'net_payable_amount'        => 'required',
    ];

    /**
     * @return hasOne
     */
    public function ipdPatient()
    {
        return $this->belongsTo(IpdPatientDepartment::class, 'ipd_patient_department_id');
    }
}
