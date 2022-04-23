<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * Class InsuranceDisease
 *
 * @property int $id
 * @property int $insurance_id
 * @property string $disease_name
 * @property float $disease_charge
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static Builder|InsuranceDisease newModelQuery()
 * @method static Builder|InsuranceDisease newQuery()
 * @method static Builder|InsuranceDisease query()
 * @method static Builder|InsuranceDisease whereCreatedAt($value)
 * @method static Builder|InsuranceDisease whereDiseaseCharge($value)
 * @method static Builder|InsuranceDisease whereDiseaseName($value)
 * @method static Builder|InsuranceDisease whereId($value)
 * @method static Builder|InsuranceDisease whereInsuranceId($value)
 * @method static Builder|InsuranceDisease whereUpdatedAt($value)
 * @mixin Eloquent
 */
class InsuranceDisease extends Model
{
    /**
     * Validation rules
     * @var array
     */
    public static $rules = [
        'insurance_id'   => 'required',
        'disease_name'   => 'required',
        'disease_charge' => 'required',
    ];
    /**
     * @var string
     */
    public $table = 'insurance_diseases';
    /**
     * @var array
     */
    public $fillable = [
        'insurance_id',
        'disease_name',
        'disease_charge',
    ];
    /**
     * The attributes that should be casted to native types.
     * @var array
     */
    protected $casts = [
        'id'           => 'integer',
        'disease_name' => 'string',
    ];
}
