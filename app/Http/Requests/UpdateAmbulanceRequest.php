<?php

namespace App\Http\Requests;

use App\Models\Ambulance;
use Illuminate\Foundation\Http\FormRequest;

class UpdateAmbulanceRequest extends FormRequest
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
        $rules = Ambulance::$rules;
        $rules['vehicle_number'] = 'required|is_unique:ambulances,vehicle_number,'.$this->route('ambulance')->id;

        return $rules;
    }
}
