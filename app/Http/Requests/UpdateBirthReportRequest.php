<?php

namespace App\Http\Requests;

use App\Models\BirthReport;
use Illuminate\Foundation\Http\FormRequest;

class UpdateBirthReportRequest extends FormRequest
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
        $rules = BirthReport::$rules;
        $rules['case_id'] = 'required|unique:birth_reports,case_id,'.$this->route('birthReport')->id;

        return $rules;
    }
}
