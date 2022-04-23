<?php

namespace App\Http\Requests;

use App\Models\ItemCategory;
use Illuminate\Foundation\Http\FormRequest;

class UpdateItemCategoryRequest extends FormRequest
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
        $rules = ItemCategory::$rules;
        $rules['name'] = 'required|is_unique:item_categories,name,'.$this->route('itemCategory')->id;

        return $rules;
    }
}
