<?php

namespace App\Models;

use App\Traits\PopulateTenantID;
use Eloquent as Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Carbon;
use Stancl\Tenancy\Database\Concerns\BelongsToTenant;

/**
 * Class Bed_Type
 *
 * @version February 17, 2020, 8:08 am UTC
 * @property int $id
 * @property string $title
 * @property string $description
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static Builder|BedType newModelQuery()
 * @method static Builder|BedType newQuery()
 * @method static Builder|BedType query()
 * @method static Builder|BedType whereCreatedAt($value)
 * @method static Builder|BedType whereDescription($value)
 * @method static Builder|BedType whereId($value)
 * @method static Builder|BedType whereTitle($value)
 * @method static Builder|BedType whereUpdatedAt($value)
 * @mixin Model
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Bed[] $beds
 * @property-read int|null $beds_count
 * @property int $is_default
 * @method static Builder|BedType whereIsDefault($value)
 */
class BedType extends Model
{
    use BelongsToTenant, PopulateTenantID;

    /**
     * @var string
     */
    public $table = 'bed_types';

    /**
     * @var array
     */
    public $fillable = [
        'title',
        'description',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
    ];

    /**
     * Validation rules
     * @var array
     */
    public static $rules = [
        'title' => 'required|is_unique:bed_types,title',
    ];

    /**
     * @return HasMany
     */
    public function beds()
    {
        return $this->hasMany(Bed::class, 'bed_type');
    }
}
