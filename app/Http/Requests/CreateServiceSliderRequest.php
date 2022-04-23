<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateServiceSliderRequest extends FormRequest
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
        return [
            'img_url' => 'required|image|mimes:jpeg,png,jpg,gif,',
        ];
    }

    /**
     * @return string[]
     */
    public function messages()
    {
        return [
            'img_url.required' => 'Service image slider field is required.',
        ];
    }
}
