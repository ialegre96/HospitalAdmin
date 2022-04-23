<?php

namespace App\Http\Requests;

use App\Models\IpdBill;
use App\Models\IpdCharge;
use App\Models\IpdPayment;
use Illuminate\Foundation\Http\FormRequest;

class CreateIpdPaymentRequest extends FormRequest
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
        $amount = $this->request->get('amount');
        $this->request->set('amount', removeCommaFromNumbers($amount));
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = IpdPayment::$rules;

        $ipdPatienId = $this->request->get('ipd_patient_department_id');
        // get tottal charges
        $totalCharges = IpdCharge::whereIpdPatientDepartmentId($ipdPatienId)->get()->sum('applied_charge');
        $ipdBill = IpdBill::whereIpdPatientDepartmentId($ipdPatienId)->first();
        $totalPayment = IpdPayment::whereIpdPatientDepartmentId($ipdPatienId)->get()->sum('amount');
        $maxAmount = ($ipdBill) ? $ipdBill->net_payable_amount : $totalCharges - $totalPayment;

        $rules['amount'] = "required|integer|min:1|max:$maxAmount";

        return $rules;
    }
}
