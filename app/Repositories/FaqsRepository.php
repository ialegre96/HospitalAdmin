<?php

namespace App\Repositories;

use App\Models\Faqs;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class FaqsRepository
 */
class FaqsRepository extends BaseRepository
{

    /**
     * @var array
     */
    protected $fieldSearchable = [
        'question',
        'answer',
    ];

    /**
     * @return array|string[]
     */
    public function getFieldsSearchable(): array
    {
        return $this->fieldSearchable;
    }

    /**
     * @return string
     */
    public function model()
    {
        return Faqs::class;
    }

    /**
     * @param $input
     *
     * @return mixed
     */
    public function store($input)
    {
        $faqs = Faqs::create($input);

        return $faqs;
    }


    /**
     * @param  array  $input
     *
     * @param $faqs
     *
     * @return Builder|Builder[]|Collection|Model
     */
    public function updateFaqs($input, $faqs)
    {
        $faqs->update($input);

        return $faqs;
    }
}
