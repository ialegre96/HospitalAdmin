<?php

namespace App\Http\Requests;

use App\Models\Visitor;
use Illuminate\Foundation\Http\FormRequest;

class UpdateVisitorRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = Visitor::$rules;
        $rules['no_of_person'] = 'max:4';

        return $rules;
    }
}
