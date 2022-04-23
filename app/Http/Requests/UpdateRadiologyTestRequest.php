<?php

namespace App\Http\Requests;

use App\Models\RadiologyTest;
use Illuminate\Foundation\Http\FormRequest;

class UpdateRadiologyTestRequest extends FormRequest
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
        $rules = RadiologyTest::$rules;
        $rules['test_name'] = 'required|is_unique:radiology_tests,test_name,'.$this->route('radiologyTest')->id;

        return $rules;
    }
}
