<?php

namespace App\Models;

use App\Traits\PopulateTenantID;
use Eloquent as Model;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Stancl\Tenancy\Database\Concerns\BelongsToTenant;

/**
 * Class ItemStock
 *
 * @version August 26, 2020, 12:50 pm UTC
 * @property int $item_category_id
 * @property int $item_id
 * @property string $supplier_name
 * @property string $store_name
 * @property int $quantity
 * @property number $purchase_price
 * @property string $description
 * @property int $id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Item $item
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ItemStock newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ItemStock newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ItemStock query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ItemStock whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ItemStock whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ItemStock whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ItemStock whereItemCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ItemStock whereItemId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ItemStock wherePurchasePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ItemStock whereQuantity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ItemStock whereStoreName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ItemStock whereSupplierName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ItemStock whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property-read mixed $item_stock_url
 * @property-read Collection|Media[] $media
 * @property-read int|null $media_count
 */
class ItemStock extends Model implements HasMedia
{
    use InteractsWithMedia, BelongsToTenant, PopulateTenantID;

    public const PATH = 'item_stocks';
    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'item_category_id' => 'required',
        'item_id'          => 'required',
        'supplier_name'    => 'nullable',
        'store_name'       => 'nullable',
        'quantity'         => 'required',
        'purchase_price'   => 'required',
        'description'      => 'nullable',
        'attachment'       => 'nullable|mimes:jpeg,png,pdf,docx,doc',
    ];
    public $table = 'item_stocks';
    public $fillable = [
        'item_category_id',
        'item_id',
        'supplier_name',
        'store_name',
        'quantity',
        'purchase_price',
        'description',
    ];
    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id'               => 'integer',
        'item_category_id' => 'integer',
        'item_id'          => 'integer',
        'supplier_name'    => 'string',
        'store_name'       => 'string',
        'quantity'         => 'integer',
        'purchase_price'   => 'double',
        'description'      => 'string',
    ];
    protected $appends = ['item_stock_url'];

    /**
     * @return mixed
     */
    public function getItemStockUrlAttribute()
    {
        /** @var Media $media */
        $media = $this->media->first();
        if (! empty($media)) {
            return $media->getFullUrl();
        }

        return '';
    }

    /**
     * @return BelongsTo
     */
    public function item()
    {
        return $this->belongsTo(Item::class, 'item_id');
    }
}
