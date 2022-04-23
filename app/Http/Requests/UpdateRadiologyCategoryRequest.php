<?php

namespace App\Http\Requests;

use App\Models\RadiologyCategory;
use Illuminate\Foundation\Http\FormRequest;

class UpdateRadiologyCategoryRequest extends FormRequest
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
        $rules = RadiologyCategory::$rules;
        $rules['name'] = 'required|is_unique:radiology_categories,name,'.$this->route('radiologyCategory')->id;

        return $rules;
    }
}
