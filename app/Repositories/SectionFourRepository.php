<?php

namespace App\Repositories;

use App\Models\SectionFour;
use Exception;
use Symfony\Component\HttpKernel\Exception\UnprocessableEntityHttpException;

/**
 * Class ServiceRepository
 * @version February 25, 2020, 10:50 am UTC
 */
class SectionFourRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'text_main',
        'text_secondary',
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
        return SectionFour::class;
    }

    /**
     * @param $input
     * @return SectionFour
     */
    public function updateSectionFour($input)
    {
        try {
            /** @var SectionFour $sectionFour */
            $sectionFour = SectionFour::first();
            $sectionFour->update($input);

            if (isset($input['img_url_one']) && ! empty($input['img_url_one'])) {
                $sectionFour->clearMediaCollection(SectionFour::SECTION_FOUR_CARD_ONE_PATH);
                $media = $sectionFour->addMedia($input['img_url_one'])->toMediaCollection(SectionFour::SECTION_FOUR_CARD_ONE_PATH,
                    config('app.media_disc'));
                $sectionFour->update(['img_url_one' => $media->getUrl()]);
            }
            if (isset($input['img_url_two']) && ! empty($input['img_url_two'])) {
                $sectionFour->clearMediaCollection(SectionFour::SECTION_FOUR_CARD_TWO_PATH);
                $media = $sectionFour->addMedia($input['img_url_two'])->toMediaCollection(SectionFour::SECTION_FOUR_CARD_TWO_PATH,
                    config('app.media_disc'));
                $sectionFour->update(['img_url_two' => $media->getUrl()]);
            }
            if (isset($input['img_url_three']) && ! empty($input['img_url_three'])) {
                $sectionFour->clearMediaCollection(SectionFour::SECTION_FOUR_CARD_THREE_PATH);
                $media = $sectionFour->addMedia($input['img_url_three'])->toMediaCollection(SectionFour::SECTION_FOUR_CARD_THREE_PATH,
                    config('app.media_disc'));
                $sectionFour->update(['img_url_three' => $media->getUrl()]);
            }
            if (isset($input['img_url_four']) && ! empty($input['img_url_four'])) {
                $sectionFour->clearMediaCollection(SectionFour::SECTION_FOUR_CARD_FOUR_PATH);
                $media = $sectionFour->addMedia($input['img_url_four'])->toMediaCollection(SectionFour::SECTION_FOUR_CARD_FOUR_PATH,
                    config('app.media_disc'));
                $sectionFour->update(['img_url_four' => $media->getUrl()]);
            }
            if (isset($input['img_url_five']) && ! empty($input['img_url_five'])) {
                $sectionFour->clearMediaCollection(SectionFour::SECTION_FOUR_CARD_FIVE_PATH);
                $media = $sectionFour->addMedia($input['img_url_five'])->toMediaCollection(SectionFour::SECTION_FOUR_CARD_FIVE_PATH,
                    config('app.media_disc'));
                $sectionFour->update(['img_url_five' => $media->getUrl()]);
            }
            if (isset($input['img_url_six']) && ! empty($input['img_url_six'])) {
                $sectionFour->clearMediaCollection(SectionFour::SECTION_FOUR_CARD_SIX_PATH);
                $media = $sectionFour->addMedia($input['img_url_six'])->toMediaCollection(SectionFour::SECTION_FOUR_CARD_SIX_PATH,
                    config('app.media_disc'));
                $sectionFour->update(['img_url_six' => $media->getUrl()]);
            }

            return $sectionFour;
        } catch (Exception $e) {
            throw new UnprocessableEntityHttpException($e->getMessage());
        }
    }
}
