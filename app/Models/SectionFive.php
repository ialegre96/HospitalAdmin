<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Collections\MediaCollection;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

/**
 * App\Models\SectionFive
 *
 * @property int $id
 * @property string $main_img_url
 * @property string $card_img_url_one
 * @property string $card_img_url_two
 * @property string $card_img_url_three
 * @property string $card_img_url_four
 * @property int $card_one_number
 * @property int $card_two_number
 * @property int $card_three_number
 * @property int $card_four_number
 * @property string $card_one_text
 * @property string $card_two_text
 * @property string $card_three_text
 * @property string $card_four_text
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read MediaCollection|Media[] $media
 * @property-read int|null $media_count
 * @method static \Illuminate\Database\Eloquent\Builder|SectionFive newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SectionFive newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SectionFive query()
 * @method static \Illuminate\Database\Eloquent\Builder|SectionFive whereCardFourNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SectionFive whereCardFourText($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SectionFive whereCardImgUrlFour($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SectionFive whereCardImgUrlOne($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SectionFive whereCardImgUrlThree($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SectionFive whereCardImgUrlTwo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SectionFive whereCardOneNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SectionFive whereCardOneText($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SectionFive whereCardThreeNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SectionFive whereCardThreeText($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SectionFive whereCardTwoNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SectionFive whereCardTwoText($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SectionFive whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SectionFive whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SectionFive whereMainImgUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SectionFive whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class SectionFive extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    public const SECTION_FIVE_MAIN_IMAGE_PATH = 'section_five_main_img_path';
    public const SECTION_FIVE_CARD_ONE_PATH = 'section_five_card_one_path';
    public const SECTION_FIVE_CARD_TWO_PATH = 'section_five_card_two_path';
    public const SECTION_FIVE_CARD_THREE_PATH = 'section_five_card_three_path';
    public const SECTION_FIVE_CARD_FOUR_PATH = 'section_five_card_four_path';

    /**
     * Validation rules
     * @var array
     */
    public static $rules = [
        'main_img_url'       => 'mimes:jpeg,jpg,png,svg',
        'card_img_url_one'   => 'mimes:jpeg,jpg,png,svg',
        'card_img_url_two'   => 'mimes:jpeg,jpg,png,svg',
        'card_img_url_three' => 'mimes:jpeg,jpg,png,svg',
        'card_img_url_four'  => 'mimes:jpeg,jpg,png,svg',
        'card_one_number'    => 'required|integer|max:9999',
        'card_two_number'    => 'required|integer|max:9999',
        'card_three_number'  => 'required|integer|max:9999',
        'card_four_number'   => 'required|integer|max:9999',
        'card_one_text'      => 'required|string|max:15',
        'card_two_text'      => 'required|string|max:15',
        'card_three_text'    => 'required|string|max:15',
        'card_four_text'     => 'required|string|max:15',
    ];
    /**
     * @var array
     */
    public $fillable = [
        'main_img_url',
        'card_img_url_one',
        'card_img_url_two',
        'card_img_url_three',
        'card_img_url_four',
        'card_one_number',
        'card_two_number',
        'card_three_number',
        'card_four_number',
        'card_one_text',
        'card_two_text',
        'card_three_text',
        'card_four_text',
    ];
}
