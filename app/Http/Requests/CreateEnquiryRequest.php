<?php

namespace App\Http\Requests;

use App\Models\Enquiry;
use App\Rules\ValidRecaptcha;
use Illuminate\Foundation\Http\FormRequest;

class CreateEnquiryRequest extends FormRequest
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

        $rules = Enquiry::$rules;
        if (getSettingForReCaptcha(request()->get('hospital_username')) == true) {
            $rules['g-recaptcha-response'] = ['required', new ValidRecaptcha];
        }

        return $rules;
    }

    /**
     * @return string[]
     */
    public function messages()
    {
        return Enquiry::$reCaptchaAttributes;
    }
}
