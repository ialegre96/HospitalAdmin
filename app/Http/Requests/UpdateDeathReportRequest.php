<?php

namespace App\Http\Requests;

use App\Models\DeathReport;
use Illuminate\Foundation\Http\FormRequest;

class UpdateDeathReportRequest extends FormRequest
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
        $rules = DeathReport::$rules;
        $rules['case_id'] = 'required|unique:death_reports,case_id,'.$this->route('deathReport')->id;

        return $rules;
    }
}
