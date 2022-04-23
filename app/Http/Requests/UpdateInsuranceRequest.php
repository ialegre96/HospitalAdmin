<?php

namespace App\Http\Requests;

use App\Models\Insurance;
use Illuminate\Foundation\Http\FormRequest;

class UpdateInsuranceRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     * @return array
     */
    public function rules()
    {
        $rules = Insurance::$rules;
        $rules['name'] = 'required|is_unique:insurances,name,'.$this->route('insurance')->id;

        return $rules;
    }
}
