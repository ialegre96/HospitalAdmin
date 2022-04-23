<?php

namespace App\Models;

use App\Traits\PopulateTenantID;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Stancl\Tenancy\Database\Concerns\BelongsToTenant;

/**
 * App\Models\Visitor
 *
 * @property int $id
 * @property int $purpose
 * @property string $name
 * @property string|null $phone
 * @property string|null $id_card
 * @property string|null $no_of_person
 * @property string|null $date
 * @property string|null $in_time
 * @property string|null $out_time
 * @property string|null $note
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read mixed $document_url
 * @property-read \Spatie\MediaLibrary\MediaCollections\Models\Collections\MediaCollection|Media[] $media
 * @property-read int|null $media_count
 * @method static \Illuminate\Database\Eloquent\Builder|Visitor newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Visitor newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Visitor query()
 * @method static \Illuminate\Database\Eloquent\Builder|Visitor whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Visitor whereDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Visitor whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Visitor whereIdCard($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Visitor whereInTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Visitor whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Visitor whereNoOfPerson($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Visitor whereNote($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Visitor whereOutTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Visitor wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Visitor wherePurpose($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Visitor whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Visitor extends Model implements HasMedia
{
    use BelongsToTenant, PopulateTenantID;

    use InteractsWithMedia;

    protected $table = 'visitors';

    const PATH = 'visitors';
    const PURPOSE = [
        1 => 'Visit',
        2 => 'Enquiry',
        3 => 'Seminar',
    ];

    const FILTER_PURPOSE = [
        0 => 'All',
        1 => 'Visit',
        2 => 'Enquiry',
        3 => 'Seminar',
    ];

    protected $fillable = [
        'purpose',
        'name',
        'phone',
        'id_card',
        'no_of_person',
        'date',
        'in_time',
        'out_time',
        'note',
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'purpose' => 'required',
        'name'    => 'required',
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
        /**
         * @var Media $media
         */
        $media = $this->media->first();
        if (! empty($media)) {
            return $media->getFullUrl();
        }

        return '';
    }
}
