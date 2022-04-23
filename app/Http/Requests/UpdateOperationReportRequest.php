<?php

namespace App\Http\Requests;

use App\Models\OperationReport;
use Illuminate\Foundation\Http\FormRequest;

class UpdateOperationReportRequest extends FormRequest
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
        $rules = OperationReport::$rules;
        $rules['case_id'] = 'required|unique:operation_reports,case_id,'.$this->route('operationReport')->id;

        return $rules;
    }
}
