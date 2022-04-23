<?php

namespace App\Http\Requests;

use App\Models\SuperAdminEnquiry;
use App\Rules\ValidRecaptcha;
use Illuminate\Foundation\Http\FormRequest;

class CreateSuperAdminEnquiryRequest extends FormRequest
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
        $rules = SuperAdminEnquiry::$rules;
        $rules['g-recaptcha-response'] = ['required', new ValidRecaptcha];

        return $rules;
    }

    /**
     * @return string[]
     */
    public function messages()
    {
        return SuperAdminEnquiry::$reCaptchaAttributes;
    }
}
