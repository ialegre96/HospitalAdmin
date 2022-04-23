<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Collections\MediaCollection;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Illuminate\Database\Eloquent\Builder;

/**
 * App\Models\LandingAboutUs
 *
 * @property int $id
 * @property string $text_main
 * @property string $card_img_one
 * @property string $card_img_two
 * @property string $card_img_three
 * @property string $main_img_one
 * @property string $main_img_two
 * @property string $card_one_text
 * @property string $card_two_text
 * @property string $card_three_text
 * @property string $card_one_text_secondary
 * @property string $card_two_text_secondary
 * @property string $card_three_text_secondary
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read MediaCollection|Media[] $media
 * @property-read int|null $media_count
 * @method static Builder|LandingAboutUs newModelQuery()
 * @method static Builder|LandingAboutUs newQuery()
 * @method static Builder|LandingAboutUs query()
 * @method static Builder|LandingAboutUs whereCardImgOne($value)
 * @method static Builder|LandingAboutUs whereCardImgThree($value)
 * @method static Builder|LandingAboutUs whereCardImgTwo($value)
 * @method static Builder|LandingAboutUs whereCardOneText($value)
 * @method static Builder|LandingAboutUs whereCardOneTextSecondary($value)
 * @method static Builder|LandingAboutUs whereCardThreeText($value)
 * @method static Builder|LandingAboutUs whereCardThreeTextSecondary($value)
 * @method static Builder|LandingAboutUs whereCardTwoText($value)
 * @method static Builder|LandingAboutUs whereCardTwoTextSecondary($value)
 * @method static Builder|LandingAboutUs whereCreatedAt($value)
 * @method static Builder|LandingAboutUs whereId($value)
 * @method static Builder|LandingAboutUs whereMainImgOne($value)
 * @method static Builder|LandingAboutUs whereMainImgTwo($value)
 * @method static Builder|LandingAboutUs whereTextMain($value)
 * @method static Builder|LandingAboutUs whereUpdatedAt($value)
 * @mixin Eloquent
 */
class LandingAboutUs extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    public const LANDING_ABOUT_US_CARD_IMG_ONE = 'landing_about_us_card_img_one';
    public const LANDING_ABOUT_US_CARD_IMG_TWO = 'landing_about_us_card_img_two';
    public const LANDING_ABOUT_US_CARD_IMG_THREE = 'landing_about_us_card_img_three';
    public const LANDING_ABOUT_US_MAIN_IMG_ONE = 'landing_about_us_main_img_one';
    public const LANDING_ABOUT_US_MAIN_IMG_TWO = 'landing_about_us_main_img_two';

    protected $table = 'landing_about_us';
    
    /**
     * Validation rules
     * @var array
     */
    public static $rules = [
        'text_main'                 => 'required|string|max:20',
        'card_img_one'              => 'mimes:jpeg,jpg,png,svg',
        'card_img_two'              => 'mimes:jpeg,jpg,png,svg',
        'card_img_three'            => 'mimes:jpeg,jpg,png,svg',
        'main_img_one'              => 'mimes:jpeg,jpg,png,svg',
        'main_img_two'              => 'mimes:jpeg,jpg,png,svg',
        'card_one_text'             => 'required|string|max:20',
        'card_two_text'             => 'required|string|max:20',
        'card_three_text'           => 'required|string|max:20',
        'card_one_text_secondary'   => 'required|string|max:135',
        'card_two_text_secondary'   => 'required|string|max:135',
        'card_three_text_secondary' => 'required|string|max:135',
    ];
    
    /**
     * @var array
     */
    public $fillable = [
        'text_main',
        'card_img_one',
        'card_img_two',
        'card_img_three',
        'main_img_one',
        'main_img_two',
        'card_one_text',
        'card_two_text',
        'card_three_text',
        'card_one_text_secondary',
        'card_two_text_secondary',
        'card_three_text_secondary',
    ];
}
