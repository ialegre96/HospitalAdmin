<div class="row gx-10 mb-5">
    <div class="col-lg-3 col-md-4 col-sm-12 mb-5">
        {{ Form::label('patient_admission_id', __('messages.bill.admission_id').(':'),['class'=>'form-label required fs-6 fw-bolder text-gray-700 mb-3']) }}
        {{ Form::select('patient_admission_id', $patientAdmissionIds, null, ['class' => 'form-select form-select-solid fw-bold', 'id' => 'patientAdmissionId', 'placeholder' => 'Select Admission Id','data-control' => 'select2', 'required']) }}
    </div>
    {{ Form::hidden('patient_admission_id', null, ['id' => 'pAdmissionId']) }}
    {{ Form::hidden('patient_id', null, ['id' => 'patientId']) }}
    @if(isset($bill))
        <div class="col-lg-3 col-md-4 col-sm-12 mb-5">
            {{ Form::label('bill_date', __('messages.bill.bill_date').(':'),['class'=>'form-label required fs-6 fw-bolder text-gray-700 mb-3']) }}
            {{ Form::text('bill_date', null, ['class' => 'form-control form-control-solid', 'id' => 'editBillDate', 'autocomplete' => 'off']) }}
        </div>
    @else
        <div class="col-lg-3 col-md-4 col-sm-12 mb-5">
            {{ Form::label('bill_date', __('messages.bill.bill_date').(':'),['class'=>'form-label required fs-6 fw-bolder text-gray-700 mb-3']) }}
            {{ Form::text('bill_date', null, ['class' => 'form-control form-control-solid', 'id' => 'bill_date', 'autocomplete' => 'off']) }}
        </div>
    @endif
    <div class="col-lg-3 col-md-4 col-sm-12 mb-5 myclass">
        {{ Form::label('name', __('messages.case.patient').(':'),['class'=>'form-label fs-6 fw-bolder text-gray-700 mb-3']) }}
        {{ Form::text('name', null, ['class' => 'form-control form-control-solid', 'id' => 'name', 'readonly']) }}
    </div>
    <div class="col-lg-3 col-md-4 col-sm-12 mb-5">
        {{ Form::label('email', __('messages.bill.patient_email').(':'),['class'=>'form-label fs-6 fw-bolder text-gray-700 mb-3']) }}
        {{ Form::text('email', null, ['class' => 'form-control form-control-solid', 'id' => 'userEmail', 'readonly']) }}
    </div>
    <div class="col-lg-3 col-md-4 col-sm-12 mb-5">
        {{ Form::label('phone', __('messages.bill.patient_cell_no').(':'),['class'=>'form-label fs-6 fw-bolder text-gray-700 mb-3']) }}
        {{ Form::text('phone', null, ['class' => 'form-control form-control-solid', 'id' => 'userPhone', 'readonly']) }}
    </div>
    <div class="col-lg-3 col-md-4 col-sm-12 mb-5">
        {{ Form::label('gender', __('messages.bill.patient_gender').(':'),['class'=>'form-label fs-6 fw-bolder text-gray-700 mb-3']) }}
        <br>
        <span class="form-check form-check-custom form-check-solid is-valid form-check-sm">
            <label class="form-label fs-6 fw-bolder text-gray-700 m-3">{{ __('messages.user.male') }}</label>&nbsp;&nbsp;
            {{ Form::radio('gender', '0', true, ['class' => 'form-check-input', 'tabindex' => '6']) }} &nbsp;
            <label class="form-label fs-6 fw-bolder text-gray-700 m-3">{{ __('messages.user.female') }}</label>
            {{ Form::radio('gender', '1', false, ['class' => 'form-check-input', 'tabindex' => '7']) }}
        </span>
    </div>
    <div class="col-lg-3 col-md-4 col-sm-12 mb-5">
        {{ Form::label('dob', __('messages.bill.patient_dob').(':'),['class'=>'form-label fs-6 fw-bolder text-gray-700 mb-3']) }}
        {{ Form::text('dob', null, ['class' => 'form-control form-control-solid', 'id' => 'dob', 'readonly']) }}
    </div>
    <div class="col-lg-3 col-md-4 col-sm-12 mb-5">
        {{ Form::label('doctor_id', __('messages.case.doctor').(':'),['class'=>'form-label fs-6 fw-bolder text-gray-700 mb-3']) }}
        {{ Form::text('doctor_id', null, ['class' => 'form-control form-control-solid', 'id' => 'doctorId', 'readonly']) }}
    </div>
    <div class="col-lg-3 col-md-4 col-sm-12 mb-5">
        {{ Form::label('admission_date', __('messages.bill.admission_date').(':'),['class'=>'form-label fs-6 fw-bolder text-gray-700 mb-3']) }}
        {{ Form::text('admission_date', null, ['class' => 'form-control form-control-solid', 'id' => 'admissionDate', 'readonly']) }}
    </div>
    <div class="col-lg-3 col-md-4 col-sm-12 mb-5">
        {{ Form::label('discharge_date', __('messages.bill.discharge_date').(':'),['class'=>'form-label fs-6 fw-bolder text-gray-700 mb-3']) }}
        {{ Form::text('discharge_date', null, ['class' => 'form-control form-control-solid', 'id' => 'dischargeDate', 'readonly']) }}
    </div>
    <div class="col-lg-3 col-md-4 col-sm-12 mb-5">
        {{ Form::label('package_id', __('messages.bill.package_name').(':'),['class'=>'form-label fs-6 fw-bolder text-gray-700 mb-3']) }}
        {{ Form::text('package_id', null, ['class' => 'form-control form-control-solid', 'id' => 'packageId', 'readonly']) }}
    </div>
    <div class="col-lg-3 col-md-4 col-sm-12 mb-5">
        {{ Form::label('insurance_id', __('messages.bill.insurance_name').(':'),['class'=>'form-label fs-6 fw-bolder text-gray-700 mb-3']) }}
        {{ Form::text('insurance_id', null, ['class' => 'form-control form-control-solid', 'id' => 'insuranceId', 'readonly']) }}
    </div>
    <div class="col-lg-3 col-md-4 col-sm-12 mb-5">
        {{ Form::label('total_days', __('messages.bill.total_days').(':'),['class'=>'form-label fs-6 fw-bolder text-gray-700 mb-3']) }}
        {{ Form::text('total_days', null, ['class' => 'form-control form-control-solid', 'id' => 'totalDays', 'readonly']) }}
    </div>
    <div class="col-lg-3 col-md-4 col-sm-12 mb-5">
        {{ Form::label('policy_no', __('messages.bill.policy_no').(':'),['class'=>'form-label fs-6 fw-bolder text-gray-700 mb-3']) }}
        {{ Form::text('policy_no', null, ['class' => 'form-control form-control-solid', 'id' => 'policyNo', 'readonly']) }}
    </div>
</div>

<div class="com-sm-12">
    <div class="table-responsive-sm">
        <table class="table align-middle table-row-dashed fs-6 gy-5 dataTable no-footer" id="billTbl">
            <thead class="thead-dark">
            <tr class="text-start text-muted fw-bolder fs-7 text-uppercase gs-0">
                <th class="text-center">#</th>
                <th class="required">{{ __('messages.bill.item_name') }}</th>
                <th class="required">{{ __('messages.bill.qty') }}</th>
                <th class="required">{{ __('messages.bill.price') }}</th>
                <th class="text-right">{{ __('messages.bill.amount') }}</th>
                <th class="table__add-btn-heading text-center">
                    <button type="button" class="btn btn-sm btn-primary w-100"
                            id="addItem">{{ __('messages.bill.add') }}</button>
                </th>
            </tr>
            </thead>
            <tbody class="bill-item-container text-gray-600 fw-bold">
            @if(isset($bill))
                @foreach($bill->billItems as $billItem)
                    <tr>
                        <td class="text-center item-number">{{ $loop->iteration }}</td>
                        <td class="table__item-desc">
                            {{ Form::text('item_name[]', $billItem->item_name, ['class' => 'form-control itemName form-control-solid','required']) }}
                        </td>
                        <td class="table__qty">
                            {{ Form::number('qty[]', $billItem->qty, ['class' => 'form-control qty quantity form-control-solid','required']) }}
                        </td>
                        <td>
                            {{ Form::text('price[]', number_format($billItem->price), ['class' => 'form-control price-input price form-control-solid','required']) }}
                        </td>
                        <td class="amount text-right itemTotal">{{ number_format($billItem->amount) }}
                        </td>
                        <td class="text-center">
                            <i class="fa fa-trash text-danger delete-invoice-item pointer"></i>
                        </td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <td class="text-center item-number">1</td>
                    <td class="table__item-desc">
                        {{ Form::text('item_name[]', null, ['class' => 'form-control itemName form-control-solid','required']) }}
                    </td>
                    <td class="table__qty">
                        {{ Form::number('qty[]', null, ['class' => 'form-control qty quantity form-control-solid','required',]) }}
                    </td>
                    <td>
                        {{ Form::text('price[]', null, ['class' => 'form-control price-input price form-control-solid','required']) }}
                    </td>
                    <td class="amount text-right itemTotal">
                    </td>
                    <td class="text-center">
                        <i class="fa fa-trash text-danger delete-invoice-item pointer"></i>
                    </td>
                </tr>
            @endif
            </tbody>
        </table>
    </div>
    <div class="col-lg-3 col-md-4 col-sm-4 float-right p-0">
        <table class="w-100">
            <tbody class="bill-item-footer">
            <tr>
                <td class="form-label fs-6 fw-bolder text-gray-700 text-right">{{ __('messages.bill.total_amount').(':') }}</td>
                <td class="font-weight-bold text-right"><b>{{ getCurrencySymbol() }}</b>
                    <span id="total" class="price">{{ isset($bill) ? number_format($bill->amount,2) : 0 }}</span>
                </td>
            </tr>
            </tbody>
        </table>
    </div>
</div>

<!-- Total Amount Field -->
{{ Form::hidden('total_amount', null, ['class' => 'form-control', 'id' => 'totalAmount']) }}

<!-- Submit Field -->
<div class="d-flex mt-5">
{{ Form::submit(__('messages.common.save'), ['class' => 'btn btn-primary me-2','id' => 'btnSave']) }}
<a href="{{ route('bills.index') }}"
   class="btn btn-light btn-active-light-primary me-2">{{ __('messages.common.cancel') }}</a>
</div>
