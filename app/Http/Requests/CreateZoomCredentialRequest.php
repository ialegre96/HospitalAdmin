<?php

namespace App\Http\Requests;

use App\Models\UserZoomCredential;
use Illuminate\Foundation\Http\FormRequest;

/**
 * Class CreateZoomCredentialRequest
 */
class CreateZoomCredentialRequest extends FormRequest
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
        return UserZoomCredential::$rules;
    }
}
