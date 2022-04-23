<?php

namespace App\Http\Requests;

use App\Models\DoctorOPDCharge;
use Illuminate\Foundation\Http\FormRequest;

class UpdateDoctorOPDChargeRequest extends FormRequest
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
        $rules = DoctorOPDCharge::$rules;
        $rules['doctor_id'] = 'required|unique:doctor_opd_charges,doctor_id,'.$this->route('doctorOPDCharge')->id;

        return $rules;
    }

    /**
     * @return array
     */
    public function messages()
    {
        return DoctorOPDCharge::$messages;
    }
}
