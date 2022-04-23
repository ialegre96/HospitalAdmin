<?php

namespace App\Models;

use App\Traits\PopulateTenantID;
use Eloquent as Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;
use Stancl\Tenancy\Database\Concerns\BelongsToTenant;

/**
 * Class IpdPrescriptionItem
 *
 * @version September 10, 2020, 11:42 am UTC
 * @property int $ipd_prescription_id
 * @property int $category_id
 * @property int $medicine_id
 * @property string $dosage
 * @property string $instruction
 * @property int $id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\IpdPrescriptionItem newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\IpdPrescriptionItem newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\IpdPrescriptionItem query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\IpdPrescriptionItem whereCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\IpdPrescriptionItem whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\IpdPrescriptionItem whereDosage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\IpdPrescriptionItem whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\IpdPrescriptionItem whereInstruction($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\IpdPrescriptionItem whereIpdPrescriptionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\IpdPrescriptionItem whereMedicineId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\IpdPrescriptionItem whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property-read Medicine $medicine
 * @property-read Category $medicineCategory
 */
class IpdPrescriptionItem extends Model
{
    use BelongsToTenant, PopulateTenantID;

    public $table = 'ipd_prescription_items';

    public $fillable = [
        'ipd_prescription_id',
        'category_id',
        'medicine_id',
        'dosage',
        'instruction',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id'                  => 'integer',
        'ipd_prescription_id' => 'integer',
        'category_id'         => 'integer',
        'medicine_id'         => 'integer',
        'dosage'              => 'string',
        'instruction'         => 'string',
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'category_id' => 'required',
    ];

    /**
     * @return BelongsTo
     */
    public function medicineCategory()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    /**
     * @return BelongsTo
     */
    public function medicine()
    {
        return $this->belongsTo(Medicine::class, 'medicine_id');
    }
}
