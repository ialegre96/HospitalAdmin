<?php

namespace App\Http\Requests;

use App\Models\BedType;
use Illuminate\Foundation\Http\FormRequest;

class UpdateBedTypeRequest extends FormRequest
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
        $rules = BedType::$rules;
        $rules['title'] = 'required|is_unique:bed_types,title,'.$this->route('bedType')->id;

        return $rules;
    }
}
