<?php

namespace App\Models;

use App\Traits\PopulateTenantID;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Stancl\Tenancy\Database\Concerns\BelongsToTenant;

/**
 * App\Models\Income
 *
 * @property int $id
 * @property string $income_head
 * @property string $name
 * @property string|null $invoice_number
 * @property \Illuminate\Support\Carbon $date
 * @property float $amount
 * @property string|null $description
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read string $document_url
 * @property-read \Illuminate\Database\Eloquent\Collection|\Spatie\MediaLibrary\Models\Media[] $media
 * @property-read int|null $media_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Income newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Income newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Income query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Income whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Income whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Income whereDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Income whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Income whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Income whereIncomeHead($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Income whereInvoiceNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Income whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Income whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Income extends Model implements HasMedia
{
    use BelongsToTenant, PopulateTenantID, InteractsWithMedia;

    protected $table = 'incomes';
    const PATH = 'income';

    const INCOME_HEAD = [
        3 => 'Canteen Rent',
        1 => 'Hospital Charges',
        2 => 'Special Campaign',
        4 => 'Vehicle Stand Charges',
    ];

    const FILTER_INCOME_HEAD = [
        0 => 'All',
        1 => 'Hospital Charges',
        2 => 'Special Campaign',
        3 => 'Canteen Rent',
        4 => 'Vehicle Stand Charges',
    ];

    /**
     * @var string[]
     */
    public $fillable = [
        'income_head',
        'name',
        'date',
        'invoice_number',
        'amount',
        'description',
    ];

    /**
     * @var string[]
     */
    protected $casts = [
        'id'             => 'integer',
        'income_head'    => 'integer',
        'name'           => 'string',
        'date'           => 'date',
        'invoice_number' => 'string',
        'amount'         => 'double',
        'description'    => 'string',
    ];

    /**
     * @var string[]
     */
    public static $rules = [
        'income_head' => 'required|string',
        'name'        => 'required|is_unique:incomes,name',
        'date'        => 'required|date',
        'amount'      => 'required',
    ];

    /**
     * @var string[]
     */
    protected $appends = ['document_url'];

    /**
     * @return string
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
