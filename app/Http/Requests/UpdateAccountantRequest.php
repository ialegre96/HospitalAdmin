<?php

namespace App\Http\Requests;

use App\Models\Accountant;
use Illuminate\Foundation\Http\FormRequest;

class UpdateAccountantRequest extends FormRequest
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
        $rules = Accountant::$rules;
        $rules['email'] = 'required|email:filter|is_unique:users,email,'.$this->route('accountant')->user->id;

        return $rules;
    }
}
