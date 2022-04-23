<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateBulkBedRequest extends FormRequest
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
        return [
            'name.*'     => 'required|distinct|is_unique:beds,name',
            'bed_type.*' => 'required',
            'charge.*'   => 'required|numeric|min:0',
        ];
    }

    public function messages()
    {
        return [
            'name.*.distinct' => 'The Bed field has a duplicate value.',
            'name.*.unique'   => 'The Bed :input has already been taken.',
        ];
    }
}
