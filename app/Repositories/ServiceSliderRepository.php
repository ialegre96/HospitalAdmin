<?php

namespace App\Repositories;

use App\Models\ServiceSlider;
use Illuminate\Database\Eloquent\Builder;
use Spatie\MediaLibrary\MediaCollections\Exceptions\FileDoesNotExist;
use Spatie\MediaLibrary\MediaCollections\Exceptions\FileIsTooBig;

/**
 * Class ServiceSliderRepository
 */
class ServiceSliderRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'id',
    ];

    /**
     * @return array|string[]
     */
    public function getFieldsSearchable()
    {
        return $this->fieldSearchable;
    }

    /**
     * @return string
     */
    public function model()
    {
        return ServiceSlider::class;
    }

    /**
     * @param $input
     *
     * @throws FileDoesNotExist
     *
     * @throws FileIsTooBig
     *
     */
    public function store($input)
    {
        $serviceSlider = ServiceSlider::create($input);

        if (isset($input['img_url']) && ! empty($input['img_url'])) {
            $media = $serviceSlider->addMedia($input['img_url'])->toMediaCollection(ServiceSlider::SERVICE_SLIDER,
                config('app.media_disc'));
            $serviceSlider->update(['img_url' => $media->getUrl()]);
        }

        return $serviceSlider;
    }

    /**
     * @param  array  $input
     *
     * @param $id
     *
     * @throws FileDoesNotExist
     *
     * @throws FileIsTooBig
     *
     * @return int
     */
    public function update($input, $id)
    {
        $serviceSlider = ServiceSlider::findOrFail($id);
        $serviceSlider->update($input);

        if (isset($input['img_url']) && ! empty($input['img_url'])) {
            $serviceSlider->clearMediaCollection(ServiceSlider::SERVICE_SLIDER);
            $serviceSlider->media()->delete();
            $serviceSlider->addMedia($input['img_url'])->toMediaCollection(ServiceSlider::SERVICE_SLIDER,
                config('app.media_disc'));
        }

        return $serviceSlider;
    }
}
