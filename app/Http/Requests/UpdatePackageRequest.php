<?php

namespace App\Http\Requests;

use App\Models\Package;
use Illuminate\Foundation\Http\FormRequest;

class UpdatePackageRequest extends FormRequest
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
     *
     * @return array
     */
    public function rules()
    {
        $rules = Package::$rules;
        $rules['name'] = 'required|is_unique:packages,name,'.$this->route('package')->id;

        return $rules;
    }
}
