<?php

namespace App\Http\Requests;

use App\Models\Income;
use Illuminate\Foundation\Http\FormRequest;

class UpdateIncomeRequest extends FormRequest
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
        $rules = Income::$rules;
        $rules['name'] = 'required|is_unique:incomes,name,'.$this->route('income')->id;

        return $rules;
    }
}
