<?php

namespace App\Http\Requests;

use App\Models\LabTechnician;
use Illuminate\Foundation\Http\FormRequest;

class UpdateLabTechnicianRequest extends FormRequest
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
        $rules = LabTechnician::$rules;
        $rules['email'] = 'required|email:filter|is_unique:users,email,'.$this->route('lab_technician')->user->id;

        return $rules;
    }
}
