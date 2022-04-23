<?php

namespace App\Http\Requests;

use App\Models\User;
use Auth;
use Illuminate\Foundation\Http\FormRequest;

class UpdateUserProfileRequest extends FormRequest
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
     * @return array The given data was invalid.
     */
    public function rules()
    {
        $id = Auth::user()->id;
        $rules = [
            'first_name' => 'required',
            'last_name'  => 'nullable',
            'email'      => 'required|email:filter|is_unique:users,email,'.$id.'|regex:/^[\w\-\.\+]+\@[a-zA-Z0-9\.\-]+\.[a-zA-z0-9]{2,4}$/',
            'phone'      => 'nullable|numeric',
            'photo'      => 'mimes:jpeg,jpg,png',
        ];

        return $rules;
    }

    /**
     * @return array
     */
    public function messages()
    {
        return User::$messages;
    }
}
