<?php

namespace App\Http\Requests;

use App\Models\Medicine;
use Illuminate\Foundation\Http\FormRequest;

class CreateMedicineRequest extends FormRequest
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

    protected function prepareForValidation()
    {
        $this->sanitize();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return Medicine::$rules;
    }

    public function messages()
    {
        return Medicine::$messages;
    }

    public function sanitize()
    {
        $input = $this->all();
        $input['selling_price'] = ! empty($input['selling_price']) ? str_replace(',', '',
            $input['selling_price']) : null;
        $input['buying_price'] = ! empty($input['buying_price']) ? str_replace(',', '', $input['buying_price']) : null;
        $this->replace($input);
    }
}
