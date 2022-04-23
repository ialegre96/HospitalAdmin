<?php

namespace App\Models;

use App\Traits\PopulateTenantID;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Stancl\Tenancy\Database\Concerns\BelongsToTenant;

/**
 * App\Models\Expense
 * * @property int $id
 *
 * @property string $expense_head
 * @property string $name
 * @property string|null $invoice_number
 * @property \Illuminate\Support\Carbon $date
 * @property float $amount
 * @property string|null $description
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read mixed $document_url
 * @property-read \Illuminate\Database\Eloquent\Collection|\Spatie\MediaLibrary\Models\Media[] $media
 * @property-read int|null $media_count
 * @mixin Model
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Expense newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Expense newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Expense query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Expense whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Expense whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Expense whereDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Expense whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Expense whereExpenseHead($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Expense whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Expense whereInvoiceNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Expense whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Expense whereUpdatedAt($value)
 */
class Expense extends Model implements HasMedia
{
    use BelongsToTenant, PopulateTenantID, InteractsWithMedia;

    protected $table = 'expenses';
    const PATH = 'expenses';

    const EXPENSE_HEAD = [
        1 => 'Building Rent',
        2 => 'Equipments',
        3 => 'Electricity Bill',
        5 => 'Power Generator Fuel Charge',
        4 => 'Telephone Bill',
        6 => 'Tea Expense',
    ];

    const FILTER_EXPENSE_HEAD = [
        0 => 'All',
        1 => 'Building Rent',
        2 => 'Equipments',
        3 => 'Electricity Bill',
        4 => 'Telephone Bill',
        5 => 'Power Generator Fuel Charge',
        6 => 'Tea Expense',
    ];

    /**
     * @var string[]
     */
    public $fillable = [
        'expense_head',
        'name',
        'date',
        'invoice_number',
        'amount',
        'description',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id'             => 'integer',
        'expense_head'   => 'integer',
        'name'           => 'string',
        'date'           => 'date',
        'invoice_number' => 'string',
        'amount'         => 'double',
        'description'    => 'string',
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'expense_head' => 'required|string',
        'name'         => 'required|is_unique:expenses,name',
        'date'         => 'required|date',
        'amount'       => 'required',
    ];

    /**
     * @var array
     */
    protected $appends = ['document_url'];

    /**
     * @return mixed
     */
    public function getDocumentUrlAttribute()
    {
        /** @var Media $media */
        $media = $this->media->first();
        if (! empty($media)) {
            return $media->getFullUrl();
        }

        return '';
    }
}
