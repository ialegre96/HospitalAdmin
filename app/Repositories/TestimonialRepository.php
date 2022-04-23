<?php

namespace App\Repositories;

use App\Models\Testimonial;
use Exception;
use Symfony\Component\HttpKernel\Exception\UnprocessableEntityHttpException;

/**
 * Class TestimonialRepository
 */
class TestimonialRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'description',
    ];

    /**
     * Return searchable fields
     *
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
        return Testimonial::class;
    }

    /**
     * @param  array  $input
     *
     * @return bool
     */
    public function store($input)
    {
        try {
            /**
             * @var Testimonial $testimonial
             */
            $testimonial = $this->create($input);
            if (! empty($input['profile'])) {
                $fileExtension = getFileName('Testimonial', $input['profile']);
                $testimonial->addMedia($input['profile'])->usingFileName($fileExtension)->toMediaCollection(Testimonial::PATH,
                    config('app.media_disc'));
            }

            return true;
        } catch (Exception $e) {
            throw new UnprocessableEntityHttpException($e->getMessage());
        }
    }

    /**
     * @param  array  $input
     *
     * @param  int  $testimonialId
     */
    public function updateTestimonial($input, $testimonialId)
    {
        try {
            /**
             * @var Testimonial $testimonial
             */
            $testimonial = $this->update($input, $testimonialId);
            if (! empty($input['profile'])) {
                $testimonial->clearMediaCollection(Testimonial::PATH);
                $fileExtension = getFileName('Testimonial', $input['profile']);
                $testimonial->addMedia($input['profile'])->usingFileName($fileExtension)->toMediaCollection(Testimonial::PATH,
                    config('app.media_disc'));
            }
        } catch (Exception $e) {
            throw new UnprocessableEntityHttpException($e->getMessage());
        }
    }

    /**
     * @param  Testimonial  $testimonial
     */
    public function deleteTestimonial(Testimonial $testimonial)
    {
        try {
            $testimonial->clearMediaCollection(Testimonial::PATH);
            $this->delete($testimonial->id);
        } catch (Exception $e) {
            throw new UnprocessableEntityHttpException($e->getMessage());
        }
    }
}
