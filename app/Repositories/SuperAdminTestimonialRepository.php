<?php

namespace App\Repositories;

use App\Models\AdminTestimonial;
use Exception;
use Symfony\Component\HttpKernel\Exception\UnprocessableEntityHttpException;

/**
 * Class SuperAdminTestimonialRepository
 */
class SuperAdminTestimonialRepository extends BaseRepository
{

    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'position',
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
        return AdminTestimonial::class;
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
                $testimonial->addMedia($input['profile'])->usingFileName($fileExtension)->toMediaCollection(AdminTestimonial::PATH,
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
                $testimonial->clearMediaCollection(AdminTestimonial::PATH);
                $fileExtension = getFileName('Testimonial', $input['profile']);
                $testimonial->addMedia($input['profile'])->usingFileName($fileExtension)->toMediaCollection(AdminTestimonial::PATH,
                    config('app.media_disc'));
            }
        } catch (Exception $e) {
            throw new UnprocessableEntityHttpException($e->getMessage());
        }
    }
}
