<?php

namespace App\Http\Requests;

use App\Models\Nurse;
use Illuminate\Foundation\Http\FormRequest;

class UpdateNurseRequest extends FormRequest
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
        $rules = Nurse::$rules;
        $rules['email'] = 'required|email:filter|is_unique:users,email,'.$this->route('nurse')->user->id;

        return $rules;
    }
}
