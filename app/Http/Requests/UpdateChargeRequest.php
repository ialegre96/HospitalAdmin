<?php

namespace App\Http\Requests;

use App\Models\Charge;
use Illuminate\Foundation\Http\FormRequest;

class UpdateChargeRequest extends FormRequest
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
        $rules = Charge::$rules;
        $rules['code'] = 'required|is_unique:charges,code,'.$this->route('charge')->id;

        return $rules;
    }
}
