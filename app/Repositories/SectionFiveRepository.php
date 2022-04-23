<?php

namespace App\Repositories;

use App\Models\SectionFive;
use Exception;
use Symfony\Component\HttpKernel\Exception\UnprocessableEntityHttpException;

/**
 * Class ServiceRepository
 * @version February 25, 2020, 10:50 am UTC
 */
class SectionFiveRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'card_one_text',
        'card_two_text',
        'card_three_text',
        'card_four_text',
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
        return SectionFive::class;
    }

    /**
     * @param $input
     * @return SectionFive
     */
    public function updateSectionFive($input)
    {
        try {
            /** @var SectionFive $sectionFive */
            $sectionFive = SectionFive::first();
            $sectionFive->update($input);

            if (isset($input['main_img_url']) && ! empty($input['main_img_url'])) {
                $sectionFive->clearMediaCollection(SectionFive::SECTION_FIVE_MAIN_IMAGE_PATH);
                $media = $sectionFive->addMedia($input['main_img_url'])->toMediaCollection(SectionFive::SECTION_FIVE_MAIN_IMAGE_PATH,
                    config('app.media_disc'));
                $sectionFive->update(['main_img_url' => $media->getUrl()]);
            }
            if (isset($input['card_img_url_one']) && ! empty($input['card_img_url_one'])) {
                $sectionFive->clearMediaCollection(SectionFive::SECTION_FIVE_CARD_ONE_PATH);
                $media = $sectionFive->addMedia($input['card_img_url_one'])->toMediaCollection(SectionFive::SECTION_FIVE_CARD_ONE_PATH,
                    config('app.media_disc'));
                $sectionFive->update(['card_img_url_one' => $media->getUrl()]);
            }
            if (isset($input['card_img_url_two']) && ! empty($input['card_img_url_two'])) {
                $sectionFive->clearMediaCollection(SectionFive::SECTION_FIVE_CARD_TWO_PATH);
                $media = $sectionFive->addMedia($input['card_img_url_two'])->toMediaCollection(SectionFive::SECTION_FIVE_CARD_TWO_PATH,
                    config('app.media_disc'));
                $sectionFive->update(['card_img_url_two' => $media->getUrl()]);
            }
            if (isset($input['card_img_url_three']) && ! empty($input['card_img_url_three'])) {
                $sectionFive->clearMediaCollection(SectionFive::SECTION_FIVE_CARD_THREE_PATH);
                $media = $sectionFive->addMedia($input['card_img_url_three'])->toMediaCollection(SectionFive::SECTION_FIVE_CARD_THREE_PATH,
                    config('app.media_disc'));
                $sectionFive->update(['card_img_url_three' => $media->getUrl()]);
            }
            if (isset($input['card_img_url_four']) && ! empty($input['card_img_url_four'])) {
                $sectionFive->clearMediaCollection(SectionFive::SECTION_FIVE_CARD_FOUR_PATH);
                $media = $sectionFive->addMedia($input['card_img_url_four'])->toMediaCollection(SectionFive::SECTION_FIVE_CARD_FOUR_PATH,
                    config('app.media_disc'));
                $sectionFive->update(['card_img_url_four' => $media->getUrl()]);
            }


            return $sectionFive;
        } catch (Exception $e) {
            throw new UnprocessableEntityHttpException($e->getMessage());
        }
    }
}
