<?php

namespace App\Http\Requests;

use App\Models\IpdPatientDepartment;
use Illuminate\Foundation\Http\FormRequest;

class UpdateIpdPatientDepartmentRequest extends FormRequest
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
        return IpdPatientDepartment::$rules;
    }

    /**
     * @return array
     */
    public function messages()
    {
        return [
            'case_id.required' => 'The case field is required.',
            'bed_id.required'  => 'The bed field is required.',
        ];
    }
}
