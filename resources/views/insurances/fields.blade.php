<div class="row">
    <div class="form-group col-sm-6 mb-5">
        {{ Form::label('name', __('messages.insurance.insurance').(':'), ['class' => 'form-label fs-6 fw-bolder text-gray-700 mb-3']) }}
        <label class="required"></label>
        {{ Form::text('name', null, ['class' => 'form-control form-control-solid', 'required']) }}
    </div>
    <div class="form-group col-sm-6 mb-5">
        {{ Form::label('service_tax', __('messages.insurance.service_tax').(':'), ['class' => 'form-label fs-6 fw-bolder text-gray-700 mb-3']) }}
        <label class="required"></label>
        {{ Form::text('service_tax', null, ['class' => 'form-control form-control-solid service-tax price-input', 'required']) }}
    </div>
    <div class="form-group col-sm-6 mb-5">
        {{ Form::label('discount', __('messages.insurance.discount').(': '), ['class' => 'form-label fs-6 fw-bolder text-gray-700 mb-3']) }}
        (In percentage (%))
        {{ Form::number('discount',  null, ['id'=>'discountId','class' => 'form-control form-control-solid discount', 'min' => 0, 'max' => 100, 'step' => '.01']) }}
    </div>
    <div class="form-group col-sm-6 mb-5">
        {{ Form::label('insurance_no', __('messages.insurance.insurance_no').(':'), ['class' => 'form-label fs-6 fw-bolder text-gray-700 mb-3']) }}
        <label
            class="required"></label>
        {{ Form::text('insurance_no', null, ['class' => 'form-control form-control-solid', 'required']) }}
    </div>
    <div class="form-group col-sm-6 mb-5">
        {{ Form::label('insurance_code', __('messages.insurance.insurance_code').(':'), ['class' => 'form-label fs-6 fw-bolder text-gray-700 mb-3']) }}
        <label
            class="required"></label>
        {{ Form::text('insurance_code', null, ['class' => 'form-control form-control-solid', 'required']) }}
    </div>
    <div class="form-group col-sm-6 mb-5">
        {{ Form::label('hospital_rate', __('messages.insurance.hospital_rate').(':'), ['class' => 'form-label fs-6 fw-bolder text-gray-700 mb-3']) }}
        <label
            class="required"></label>
        {{ Form::text('hospital_rate', null, ['class' => 'form-control form-control-solid hospital-rate price-input', 'required']) }}
    </div>
    <div class="form-group col-sm-6 mb-5">
        {{ Form::label('remark', __('messages.insurance.remark').(':'), ['class' => 'form-label fs-6 fw-bolder text-gray-700 mb-3']) }}
        {{ Form::textarea('remark', null, ['class' => 'form-control form-control-solid', 'rows' => 4]) }}
    </div>
    <div class="form-group col-sm-6 mb-5">
        {{ Form::label('status', __('messages.common.status').(':'), ['class' => 'form-label fs-6 fw-bolder text-gray-700 mb-3']) }}
        <div class="form-check form-switch form-check-custom form-check-solid">
            <input class="form-check-input w-35px h-20px is-active" name="status" type="checkbox" value="1"
                   tabindex="8" {{(!isset($insurance)) ? 'checked':(($insurance->status) ? 'checked' : '')}}>
        </div>
    </div>
    <div class="col-sm-12 mt-3">
        <div class="mb-3 h5">
            {{ __('messages.insurance.disease_details') }}
        </div>
        <div class="table-responsive-sm">
            <table class="table align-middle table-row-dashed fs-6 gy-5 dataTable no-footer" id="billTbl">
                <thead class="thead-dark">
                <tr class="text-start text-muted fw-bolder fs-7 text-uppercase gs-0">
                    <th class="text-center">#</th>
                    <th class="insurance-name form-label fs-6 fw-bolder text-gray-700 mb-3'">{{ __('messages.insurance.diseases_name') }}
                    <span
                        class="required"></span></th>
                <th class="insurance-name form-label fs-6 fw-bolder text-gray-700 mb-3'">{{ __('messages.insurance.diseases_charge') }}
                    <span
                        class="required"></span></th>
                    <th class="table__add-btn-heading text-center form-label fs-6 fw-bolder text-gray-700 mb-3">
                        <button type="button" class="btn btn-sm btn-primary w-34"
                                id="addItem">{{ __('messages.common.add') }}</button>
                </th>
            </tr>
            </thead>
            <tbody class="disease-item-container">
            @if(isset($diseases))
                @foreach($diseases as $disease)
                    <tr>
                        <td class="text-center item-number">{{ $loop->iteration }}</td>
                        <td>
                            {{ Form::text('disease_name[]', $disease->disease_name, ['class' => 'form-control disease-name form-control-solid','required']) }}
                        </td>
                        <td>
                            {{ Form::text('disease_charge[]', $disease->disease_charge,
                                                    ['class' => 'form-control form-control-solid disease-charge form-control-solid price-input','required']) }}
                        </td>
                        <td class="text-center">
                            <a href="#" title="{{__('messages.common.delete')}}"
                               class="delete-btn delete-disease pointer btn btn-icon btn-bg-light btn-active-color-danger btn-sm">
                    <span class="svg-icon svg-icon-3">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24"
                             version="1.1">
                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                        <rect x="0" y="0" width="24" height="24"/>
                        <path
                            d="M6,8 L6,20.5 C6,21.3284271 6.67157288,22 7.5,22 L16.5,22 C17.3284271,22 18,21.3284271 18,20.5 L18,8 L6,8 Z"
                            fill="#000000" fill-rule="nonzero"/>
                        <path
                            d="M14,4.5 L14,4 C14,3.44771525 13.5522847,3 13,3 L11,3 C10.4477153,3 10,3.44771525 10,4 L10,4.5 L5.5,4.5 C5.22385763,4.5 5,4.72385763 5,5 L5,5.5 C5,5.77614237 5.22385763,6 5.5,6 L18.5,6 C18.7761424,6 19,5.77614237 19,5.5 L19,5 C19,4.72385763 18.7761424,4.5 18.5,4.5 L14,4.5 Z"
                            fill="#000000" opacity="0.3"/></g></svg></span>
                            </a>
                        </td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <td class="text-center item-number">1</td>
                    <td>
                        {{ Form::text('disease_name[]', null, ['class' => 'form-control form-control-solid disease-name','required']) }}
                    </td>
                    <td>
                        {{ Form::text('disease_charge[]', null, ['class' => 'form-control     form-control-solid disease-charge price-input','required']) }}
                    </td>
                    <td class="text-center">
                        <a href="#" title="{{__('messages.common.delete')}}"
                           class="delete-btn delete-disease pointer btn btn-icon btn-bg-light btn-active-color-danger btn-sm">
                    <span class="svg-icon svg-icon-3">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24"
                             version="1.1">
                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                        <rect x="0" y="0" width="24" height="24"/>
                        <path
                            d="M6,8 L6,20.5 C6,21.3284271 6.67157288,22 7.5,22 L16.5,22 C17.3284271,22 18,21.3284271 18,20.5 L18,8 L6,8 Z"
                            fill="#000000" fill-rule="nonzero"/>
                        <path
                            d="M14,4.5 L14,4 C14,3.44771525 13.5522847,3 13,3 L11,3 C10.4477153,3 10,3.44771525 10,4 L10,4.5 L5.5,4.5 C5.22385763,4.5 5,4.72385763 5,5 L5,5.5 C5,5.77614237 5.22385763,6 5.5,6 L18.5,6 C18.7761424,6 19,5.77614237 19,5.5 L19,5 C19,4.72385763 18.7761424,4.5 18.5,4.5 L14,4.5 Z"
                            fill="#000000" opacity="0.3"/></g></svg></span>
                        </a>
                    </td>
                </tr>
            @endif
            </tbody>
            </table>
            <div class="float-end p-0 mb-3">
                <table>
                    <tbody>
                    <tr>
                        <td class="font-weight-bold form-label fs-6 fw-bolder text-gray-700 mb-3">{{ __('messages.insurance.total_amount').(':') }}</td>
                        <td class="font-weight-bold text-right"><b>{{ getCurrencySymbol() }}</b>&nbsp;
                            <span id="total" class="totalAmount">{{ isset($insurance) ? number_format($insurance->total,2) : 0 }}
                                </span>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- Total Amount Field -->
    {{ Form::hidden('total', null, ['class' => 'form-control', 'id' => 'total_amount']) }}
    <div class="d-flex mt-5">
        {{ Form::submit(__('messages.common.save'), ['class' => 'btn btn-primary me-3', 'id'=>'saveBtn']) }}
        <a href="{{ route('insurances.index') }}"
           class="btn btn-light btn-active-light-primary me-2">{{ __('messages.common.cancel') }}</a>
    </div>
</div>
