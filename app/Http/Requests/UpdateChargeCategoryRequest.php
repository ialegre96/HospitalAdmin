<?php

namespace App\Http\Requests;

use App\Models\ChargeCategory;
use Illuminate\Foundation\Http\FormRequest;

class UpdateChargeCategoryRequest extends FormRequest
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
        $rules = ChargeCategory::$rules;
        $rules['name'] = 'required|is_unique:charge_categories,name,'.$this->route('charge_category')->id;

        return $rules;
    }
}
