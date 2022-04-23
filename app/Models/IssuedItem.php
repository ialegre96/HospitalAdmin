<?php

namespace App\Models;

use App\Traits\PopulateTenantID;
use Eloquent as Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;
use Stancl\Tenancy\Database\Concerns\BelongsToTenant;

/**
 * Class IssuedItem
 *
 * @version August 27, 2020, 2:15 pm UTC
 * @property int $department_id
 * @property int $user_id
 * @property string $issued_by
 * @property string $issued_date
 * @property string $return_date
 * @property int $item_category_id
 * @property int $item_id
 * @property int $quantity
 * @property string $description
 * @property int $id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Department $department
 * @property-read Item $item
 * @property-read User $user
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\IssuedItem newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\IssuedItem newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\IssuedItem query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\IssuedItem whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\IssuedItem whereDepartmentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\IssuedItem whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\IssuedItem whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\IssuedItem whereIssuedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\IssuedItem whereIssuedDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\IssuedItem whereItemCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\IssuedItem whereItemId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\IssuedItem whereQuantity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\IssuedItem whereReturnDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\IssuedItem whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\IssuedItem whereUserId($value)
 * @mixin \Eloquent
 * @property bool|null $status
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\IssuedItem whereStatus($value)
 */
class IssuedItem extends Model
{
    use BelongsToTenant, PopulateTenantID;

    public const ITEM_RETURN = 0;
    public const ITEM_RETURNED = 1;
    const STATUS_ALL = 2;
    public const STATUS_ARR = [
        self::STATUS_ALL    => 'All',
        self::ITEM_RETURN   => 'Return Item',
        self::ITEM_RETURNED => 'Returned',
    ];
    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'department_id'    => 'required',
        'user_id'          => 'required',
        'issued_by'        => 'required',
        'issued_date'      => 'required',
        'return_date'      => 'nullable',
        'item_category_id' => 'required',
        'item_id'          => 'required',
        'quantity'         => 'required',
        'description'      => 'nullable',
        'status'           => 'nullable',
    ];
    public $table = 'issued_items';
    public $fillable = [
        'department_id',
        'user_id',
        'issued_by',
        'issued_date',
        'return_date',
        'item_category_id',
        'item_id',
        'quantity',
        'description',
        'status',
    ];
    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id'               => 'integer',
        'department_id'    => 'integer',
        'user_id'          => 'integer',
        'issued_by'        => 'string',
        'issued_date'      => 'date',
        'return_date'      => 'date',
        'item_category_id' => 'integer',
        'item_id'          => 'integer',
        'quantity'         => 'integer',
        'description'      => 'string',
        'status'           => 'boolean',
    ];

    /**
     * @return BelongsTo
     */
    public function department()
    {
        return $this->belongsTo(Department::class, 'department_id');
    }

    /**
     * @return BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * @return BelongsTo
     */
    public function item()
    {
        return $this->belongsTo(Item::class, 'item_id');
    }
}
