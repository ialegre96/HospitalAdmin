<?php

namespace App\Http\Requests;

use App\Models\Receptionist;
use Illuminate\Foundation\Http\FormRequest;

class UpdateReceptionistRequest extends FormRequest
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
        $rules = Receptionist::$rules;
        $rules['email'] = 'required|email:filter|is_unique:users,email,'.$this->route('receptionist')->user->id;

        return $rules;
    }
}
