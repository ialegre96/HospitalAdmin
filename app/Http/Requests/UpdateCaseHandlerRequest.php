<?php

namespace App\Http\Requests;

use App\Models\CaseHandler;
use Illuminate\Foundation\Http\FormRequest;

class UpdateCaseHandlerRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     * @return array
     */
    public function rules()
    {
        $rules = CaseHandler::$rules;
        $rules['email'] = 'required|email|is_unique:users,email,'.$this->route('caseHandler')->user->id;

        return $rules;
    }
}
