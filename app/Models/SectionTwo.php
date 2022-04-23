<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

/**
 * App\Models\SectionTwo
 *
 * @property int $id
 * @property string $text_main
 * @property string $text_secondary
 * @property string $card_one_image
 * @property string $card_one_text
 * @property string $card_one_text_secondary
 * @property string $card_two_image
 * @property string $card_two_text
 * @property string $card_two_text_secondary
 * @property string $card_third_image
 * @property string $card_third_text
 * @property string $card_third_text_secondary
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Spatie\MediaLibrary\MediaCollections\Models\Collections\MediaCollection|\Spatie\MediaLibrary\MediaCollections\Models\Media[]
 *     $media
 * @property-read int|null $media_count
 * @method static \Illuminate\Database\Eloquent\Builder|SectionTwo newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SectionTwo newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SectionTwo query()
 * @method static \Illuminate\Database\Eloquent\Builder|SectionTwo whereCardOneImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SectionTwo whereCardOneText($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SectionTwo whereCardOneTextSecondary($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SectionTwo whereCardThirdImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SectionTwo whereCardThirdText($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SectionTwo whereCardThirdTextSecondary($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SectionTwo whereCardTwoImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SectionTwo whereCardTwoText($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SectionTwo whereCardTwoTextSecondary($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SectionTwo whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SectionTwo whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SectionTwo whereTextMain($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SectionTwo whereTextSecondary($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SectionTwo whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class SectionTwo extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    public const SECTION_TWO_CARD_ONE_PATH = 'section_two_card_one_image';
    public const SECTION_TWO_CARD_TWO_PATH = 'section_two_card_two_image';
    public const SECTION_TWO_CARD_THIRD_PATH = 'section_two_card_third_image';

    /**
     * Validation rules
     * @var array
     */
    public static $rules = [
        'text_main'                 => 'required|string|max:30',
        'text_secondary'            => 'required|string|max:160',
        'card_one_image'            => 'mimes:jpeg,jpg,png,svg',
        'card_two_image'            => 'mimes:jpeg,jpg,png,svg',
        'card_third_image'          => 'mimes:jpeg,jpg,png,svg',
        'card_one_text'             => 'required|string|max:20',
        'card_two_text'             => 'required|string|max:20',
        'card_third_text'           => 'required|string|max:20',
        'card_one_text_secondary'   => 'required|string|max:90',
        'card_two_text_secondary'   => 'required|string|max:90',
        'card_third_text_secondary' => 'required|string|max:90',
    ];
    /**
     * @var array
     */
    public $fillable = [
        'text_main',
        'text_secondary',
        'card_one_image',
        'card_one_text',
        'card_one_text_secondary',
        'card_two_image',
        'card_two_text',
        'card_two_text_secondary',
        'card_third_image',
        'card_third_text',
        'card_third_text_secondary',
    ];
}
