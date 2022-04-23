<?php

namespace App\Http\Requests;

use App\Models\InvestigationReport;
use Illuminate\Foundation\Http\FormRequest;

class UpdateInvestigationReportRequest extends FormRequest
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
        $rules = InvestigationReport::$rules;
        $rules['patient_id'] = 'required|unique:investigation_reports,patient_id,'.$this->route('investigationReport')->id;

        return $rules;
    }

    /**
     * @return array|string[]
     */
    public function messages()
    {
        return InvestigationReport::$messages;
    }
}
