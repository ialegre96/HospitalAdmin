<?php

namespace App\Http\Requests;

use App\Models\DiagnosisCategory;
use Illuminate\Foundation\Http\FormRequest;

class UpdateDiagnosisCategoryRequest extends FormRequest
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
        $rules = DiagnosisCategory::$rules;
        $rules['name'] = 'required|is_unique:diagnosis_categories,name,'.$this->route('diagnosisCategory')->id;

        return $rules;
    }
}
