<?php

namespace App\Http\Requests;

use App\Models\DoctorDepartment;
use Illuminate\Foundation\Http\FormRequest;

class UpdateDoctorDepartmentRequest extends FormRequest
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
        $rules = DoctorDepartment::$rules;
        $rules['title'] = 'required|is_unique:doctor_departments,title,'.$this->route('doctorDepartment')->id;

        return $rules;
    }
}
