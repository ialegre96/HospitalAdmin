<?php

namespace App\Http\Requests;

use App\Models\Postal;
use Illuminate\Foundation\Http\FormRequest;
use Route;

/**
 * Class PostalRequest
 */
class PostalRequest extends FormRequest
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
        return Postal::$rules;
    }

    /**
     * @return array|string[]
     */
    public function messages()
    {
        if (Route::current()->getName() == 'dispatches.store') {
            return [
                'required_if' => 'The :attribute field is required.',
            ];
        }

        return [
            'required_if' => 'The :attribute field is required.',
        ];
    }
}
