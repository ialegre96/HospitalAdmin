<?php

namespace App\Http\Requests;

use App\Models\CallLog;
use App\Models\SectionTwo;
use Illuminate\Foundation\Http\FormRequest;

class UpdateSectionTwoRequest extends FormRequest
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
        return SectionTwo::$rules;
    }
}
