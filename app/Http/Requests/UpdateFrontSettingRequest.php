<?php

namespace App\Http\Requests;

use App\Models\FrontSetting;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;

/**
 * Class UpdateFrontSettingRequest
 */
class UpdateFrontSettingRequest extends FormRequest
{
    /**
     * @throws ValidationException
     */
    public function prepareForValidation()
    {
        $description = trim(request()->get('about_us_description'));
        if (empty($description)) {
            throw ValidationException::withMessages([
                'about_us_description' => 'The about us Description field is required',
            ]);
        }
    }

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
        return FrontSetting::$rules;
    }
}
