<?php

namespace App\Http\Requests;

use App\Models\Appointment;
use App\Models\Doctor;
use Illuminate\Foundation\Http\FormRequest;

class CreateAppointmentRequest extends FormRequest
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
     * Prepare the data for validation.
     *
     * @return void
     */
    protected function prepareForValidation()
    {
        $doctorId = $this->request->get('doctor_id');
        $doctorDepartmentId = Doctor::whereId($doctorId)->first();
        $this->request->add(['department_id' => $doctorDepartmentId->doctor_department_id]);
        if (getLoggedInUser()->hasRole('Patient')) {
            $this->request->add(['patient_id' => getLoggedInUser()->owner_id]);
        }
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return Appointment::$rules;
    }
}
