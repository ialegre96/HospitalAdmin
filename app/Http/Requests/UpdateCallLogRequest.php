<?php

namespace App\Http\Requests;

use App\Models\CallLog;
use Illuminate\Foundation\Http\FormRequest;

class UpdateCallLogRequest extends FormRequest
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
        $rules = CallLog::$rules;

        return $rules;
    }
}
