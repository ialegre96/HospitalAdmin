<?php

namespace App\Http\Requests;

use App\Models\PatientDiagnosisTest;
use Illuminate\Foundation\Http\FormRequest;

class UpdatePatientDiagnosisTestRequest extends FormRequest
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
        $rules = PatientDiagnosisTest::$rules;
        $rules['patient_id'] = 'required|unique:patient_diagnosis_tests,patient_id,'.$this->route('patientDiagnosisTest')->id;

        return $rules;
    }

    /***
     * @return array
     */
    public function messages()
    {
        return PatientDiagnosisTest::$messages;
    }
}
