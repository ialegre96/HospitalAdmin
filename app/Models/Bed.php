<?php

namespace App\Models;

use App\Traits\PopulateTenantID;
use Eloquent as Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Carbon;
use Stancl\Tenancy\Database\Concerns\BelongsToTenant;
use Str;

/**
 * Class Bed
 *
 * @version February 17, 2020, 10:56 am UTC
 * @property int $id
 * @property int $bed_type
 * @property int $bed_id
 * @property string|null $description
 * @property int $charge
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static Builder|Bed newModelQuery()
 * @method static Builder|Bed newQuery()
 * @method static Builder|Bed query()
 * @method static Builder|Bed whereBedId($value)
 * @method static Builder|Bed whereBedType($value)
 * @method static Builder|Bed whereCharge($value)
 * @method static Builder|Bed whereCreatedAt($value)
 * @method static Builder|Bed whereDescription($value)
 * @method static Builder|Bed whereId($value)
 * @method static Builder|Bed whereUpdatedAt($value)
 * @mixin Model
 * @property-read BedType $bedType
 * @property int $name
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Bed whereName($value)
 * @property int $is_available
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Bed whereIsAvailable($value)
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\BedAssign[] $bedAssigns
 * @property-read int|null $bed_assigns_count
 * @property int $is_default
 * @method static Builder|Bed whereIsDefault($value)
 */
class Bed extends Model
{
    use BelongsToTenant, PopulateTenantID;

    /**
     * @var string
     */
    public $table = 'beds';

    /**
     * @var array
     */
    public $fillable = [
        'bed_type',
        'bed_id',
        'description',
        'name',
        'charge',
        'is_available',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
    ];

    const NOTAVAILABLE = 0;
    const AVAILABLE = 1;
    const AVAILABLE_ALL = 2;

    const STATUS_ARR = [
        self::AVAILABLE_ALL => 'All',
        self::AVAILABLE     => 'Available',
        self::NOTAVAILABLE  => 'Not Available',
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'bed_type' => 'required',
        'name'     => 'required|is_unique:beds,name',
        'charge'   => 'required',
    ];

    /**
     * @return string
     */
    public static function generateUniqueBedId()
    {
        $bedId = Str::random(8);
        while (true) {
            $isExist = self::whereBedId($bedId)->exists();
            if ($isExist) {
                self::generateUniqueBedId();
            }
            break;
        }

        return $bedId;
    }

    /**
     * @return BelongsTo
     */
    public function bedType()
    {
        return $this->belongsTo(BedType::class, 'bed_type');
    }

    /**
     * @return HasMany
     */
    public function bedAssigns()
    {
        return $this->hasMany(BedAssign::class, 'bed_id');
    }
}
