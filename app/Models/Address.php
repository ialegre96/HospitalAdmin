<?php

namespace App\Models;

use App\Traits\PopulateTenantID;
use Arr;
use Eloquent;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Support\Carbon;
use Stancl\Tenancy\Database\Concerns\BelongsToTenant;

/**
 * App\Models\Address
 *
 * @property int $id
 * @property int $owner_id
 * @property string $owner_type
 * @property string $address1
 * @property string|null $address2
 * @property string $city
 * @property string $zip
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Address newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Address newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Address query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Address whereAddress1($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Address whereAddress2($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Address whereCity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Address whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Address whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Address whereOwnerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Address whereOwnerType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Address whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Address whereZip($value)
 * @mixin Eloquent
 * @property-read Model|\Eloquent $owner
 */
class Address extends Model
{
    use BelongsToTenant, PopulateTenantID;

    protected $table = 'addresses';

    protected $fillable = [
        'owner_id',
        'owner_type',
        'address1',
        'address2',
        'city',
        'zip',
    ];

    protected $casts = [
        'owner_id'   => 'integer',
        'owner_type' => 'string',
        'address1'   => 'string',
        'address2'   => 'string',
        'city'       => 'string',
        'zip'        => 'string',
    ];

    /**
     * @return MorphTo
     */
    public function owner()
    {
        return $this->morphTo();
    }

    /**
     * @param  array  $input
     *
     * @return array
     */
    public static function prepareAddressArray($input)
    {
        return Arr::only(array_filter($input), [
            'address1',
            'address2',
            'city',
            'zip',
        ]);
    }
}
