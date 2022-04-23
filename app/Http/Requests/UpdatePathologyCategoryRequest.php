<?php

namespace App\Http\Requests;

use App\Models\PathologyCategory;
use Illuminate\Foundation\Http\FormRequest;

class UpdatePathologyCategoryRequest extends FormRequest
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
        $rules = PathologyCategory::$rules;
        $rules['name'] = 'required|is_unique:pathology_categories,name,'.$this->route('pathologyCategory')->id;

        return $rules;
    }
}
