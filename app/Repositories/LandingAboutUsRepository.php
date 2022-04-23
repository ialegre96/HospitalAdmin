<?php

namespace App\Repositories;

use App\Models\LandingAboutUs;
use Exception;
use Symfony\Component\HttpKernel\Exception\UnprocessableEntityHttpException;

/**
 * Class ServiceRepository
 * @version February 25, 2020, 10:50 am UTC
 */
class LandingAboutUsRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'text_main',
        'card_one_text',
        'card_two_text',
        'card_three_text',
        'card_one_text_secondary',
        'card_two_text_secondary',
        'card_three_text_secondary',
    ];

    /**
     * Return searchable fields
     * @return array
     */
    public function getFieldsSearchable()
    {
        return $this->fieldSearchable;
    }

    /**
     * Configure the Model
     **/
    public function model()
    {
        return LandingAboutUs::class;
    }

    /**
     * @param $input
     * @return LandingAboutUs
     */
    public function updateLandingAboutUs($input)
    {
        try {
            /** @var LandingAboutUs $landingAboutUs */
            $landingAboutUs = LandingAboutUs::first();
            $landingAboutUs->update($input);

            if (isset($input['card_img_one']) && ! empty($input['card_img_one'])) {
                $landingAboutUs->clearMediaCollection(LandingAboutUs::LANDING_ABOUT_US_CARD_IMG_ONE);
                $media = $landingAboutUs->addMedia($input['card_img_one'])->toMediaCollection(LandingAboutUs::LANDING_ABOUT_US_CARD_IMG_ONE,
                    config('app.media_disc'));
                $landingAboutUs->update(['card_img_one' => $media->getUrl()]);
            }
            if (isset($input['card_img_two']) && ! empty($input['card_img_two'])) {
                $landingAboutUs->clearMediaCollection(LandingAboutUs::LANDING_ABOUT_US_CARD_IMG_TWO);
                $media = $landingAboutUs->addMedia($input['card_img_two'])->toMediaCollection(LandingAboutUs::LANDING_ABOUT_US_CARD_IMG_TWO,
                    config('app.media_disc'));
                $landingAboutUs->update(['card_img_two' => $media->getUrl()]);
            }
            if (isset($input['card_img_three']) && ! empty($input['card_img_three'])) {
                $landingAboutUs->clearMediaCollection(LandingAboutUs::LANDING_ABOUT_US_CARD_IMG_THREE);
                $media = $landingAboutUs->addMedia($input['card_img_three'])->toMediaCollection(LandingAboutUs::LANDING_ABOUT_US_CARD_IMG_THREE,
                    config('app.media_disc'));
                $landingAboutUs->update(['card_img_three' => $media->getUrl()]);
            }
            if (isset($input['main_img_one']) && ! empty($input['main_img_one'])) {
                $landingAboutUs->clearMediaCollection(LandingAboutUs::LANDING_ABOUT_US_MAIN_IMG_ONE);
                $media = $landingAboutUs->addMedia($input['main_img_one'])->toMediaCollection(LandingAboutUs::LANDING_ABOUT_US_MAIN_IMG_ONE,
                    config('app.media_disc'));
                $landingAboutUs->update(['main_img_one' => $media->getUrl()]);
            }
            if (isset($input['main_img_two']) && ! empty($input['main_img_two'])) {
                $landingAboutUs->clearMediaCollection(LandingAboutUs::LANDING_ABOUT_US_MAIN_IMG_TWO);
                $media = $landingAboutUs->addMedia($input['main_img_two'])->toMediaCollection(LandingAboutUs::LANDING_ABOUT_US_MAIN_IMG_TWO,
                    config('app.media_disc'));
                $landingAboutUs->update(['main_img_two' => $media->getUrl()]);
            }
            
            return $landingAboutUs;
        } catch (Exception $e) {
            throw new UnprocessableEntityHttpException($e->getMessage());
        }
    }
}
