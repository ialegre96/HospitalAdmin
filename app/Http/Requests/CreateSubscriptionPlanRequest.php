<?php

namespace App\Http\Requests;

use App\Models\SubscriptionPlan;
use Illuminate\Foundation\Http\FormRequest;

class CreateSubscriptionPlanRequest extends FormRequest
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
        $price = $this->request->get('price');
        $this->request->set('price', removeCommaFromNumbers($price));
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return SubscriptionPlan::$rules;
    }
}
