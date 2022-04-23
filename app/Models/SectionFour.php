<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

/**
 * App\Models\SectionFour
 *
 * @property int $id
 * @property string $text_main
 * @property string $text_secondary
 * @property string $img_url_one
 * @property string $img_url_two
 * @property string $img_url_three
 * @property string $img_url_four
 * @property string $img_url_five
 * @property string $img_url_six
 * @property string $card_text_one
 * @property string $card_text_two
 * @property string $card_text_three
 * @property string $card_text_four
 * @property string $card_text_five
 * @property string $card_text_six
 * @property string $card_text_one_secondary
 * @property string $card_text_two_secondary
 * @property string $card_text_three_secondary
 * @property string $card_text_four_secondary
 * @property string $card_text_five_secondary
 * @property string $card_text_six_secondary
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Spatie\MediaLibrary\MediaCollections\Models\Collections\MediaCollection|\Spatie\MediaLibrary\MediaCollections\Models\Media[]
 *     $media
 * @property-read int|null $media_count
 * @method static \Illuminate\Database\Eloquent\Builder|SectionFour newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SectionFour newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SectionFour query()
 * @method static \Illuminate\Database\Eloquent\Builder|SectionFour whereCardTextFive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SectionFour whereCardTextFiveSecondary($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SectionFour whereCardTextFour($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SectionFour whereCardTextFourSecondary($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SectionFour whereCardTextOne($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SectionFour whereCardTextOneSecondary($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SectionFour whereCardTextSix($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SectionFour whereCardTextSixSecondary($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SectionFour whereCardTextThree($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SectionFour whereCardTextThreeSecondary($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SectionFour whereCardTextTwo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SectionFour whereCardTextTwoSecondary($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SectionFour whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SectionFour whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SectionFour whereImgUrlFive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SectionFour whereImgUrlFour($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SectionFour whereImgUrlOne($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SectionFour whereImgUrlSix($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SectionFour whereImgUrlThree($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SectionFour whereImgUrlTwo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SectionFour whereTextMain($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SectionFour whereTextSecondary($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SectionFour whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class SectionFour extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    public const SECTION_FOUR_CARD_ONE_PATH = 'section_four_card_one_path';
    public const SECTION_FOUR_CARD_TWO_PATH = 'section_four_card_two_path';
    public const SECTION_FOUR_CARD_THREE_PATH = 'section_four_card_three_path';
    public const SECTION_FOUR_CARD_FOUR_PATH = 'section_four_card_four_path';
    public const SECTION_FOUR_CARD_FIVE_PATH = 'section_four_card_five_path';
    public const SECTION_FOUR_CARD_SIX_PATH = 'section_four_card_six_path';

    /**
     * Validation rules
     * @var array
     */
    public static $rules = [
        'text_main'                 => 'required|string|max:30',
        'text_secondary'            => 'required|string|max:160',
        'img_url_one'               => 'mimes:jpeg,jpg,png,svg',
        'img_url_two'               => 'mimes:jpeg,jpg,png,svg',
        'img_url_three'             => 'mimes:jpeg,jpg,png,svg',
        'img_url_four'              => 'mimes:jpeg,jpg,png,svg',
        'img_url_five'              => 'mimes:jpeg,jpg,png,svg',
        'img_url_six'               => 'mimes:jpeg,jpg,png,svg',
        'card_text_one'             => 'required|string|max:20',
        'card_text_two'             => 'required|string|max:20',
        'card_text_three'           => 'required|string|max:20',
        'card_text_four'            => 'required|string|max:20',
        'card_text_five'            => 'required|string|max:20',
        'card_text_six'             => 'required|string|max:20',
        'card_text_one_secondary'   => 'required|string|max:100',
        'card_text_two_secondary'   => 'required|string|max:100',
        'card_text_three_secondary' => 'required|string|max:100',
        'card_text_four_secondary'  => 'required|string|max:100',
        'card_text_five_secondary'  => 'required|string|max:100',
        'card_text_six_secondary'   => 'required|string|max:100',
    ];
    /**
     * @var array
     */
    public $fillable = [
        'text_main',
        'text_secondary',
        'img_url_one',
        'img_url_two',
        'img_url_three',
        'img_url_four',
        'img_url_five',
        'img_url_six',
        'card_text_one',
        'card_text_two',
        'card_text_three',
        'card_text_four',
        'card_text_five',
        'card_text_six',
        'card_text_one_secondary',
        'card_text_two_secondary',
        'card_text_three_secondary',
        'card_text_four_secondary',
        'card_text_five_secondary',
        'card_text_six_secondary',
    ];
}
