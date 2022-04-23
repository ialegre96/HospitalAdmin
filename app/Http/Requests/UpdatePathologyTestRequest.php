<?php

namespace App\Http\Requests;

use App\Models\PathologyTest;
use Illuminate\Foundation\Http\FormRequest;

class UpdatePathologyTestRequest extends FormRequest
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
        $rules = PathologyTest::$rules;
        $rules['test_name'] = 'required|is_unique:pathology_tests,test_name,'.$this->route('pathologyTest')->id;

        return $rules;
    }
}
