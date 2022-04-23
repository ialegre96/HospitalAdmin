<?php

namespace App\Http\Requests;

use App\Models\Subscribe;
use Illuminate\Foundation\Http\FormRequest;

class CreateSubscribeRequest extends FormRequest
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
        return Subscribe::$rules;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'email.unique' => 'The email has already subscribe.',
        ];
    }
}
