<div class="row">
    <div class="col-md-6 col-sm-6">
        <div class="form-group mb-5">
            {{ Form::label('name', __('messages.package.package').(':'),['class' => 'form-label required fs-6 fw-bolder text-gray-700 mb-3']) }}
            {{ Form::text('name', null, ['class' => 'form-control form-control-solid']) }}
        </div>
    </div>
    <div class="col-md-6 col-sm-6">
        <div class="form-group mb-5">
            {{ Form::label('discount', __('messages.package.discount').(':'),['class' => 'form-label required fs-6 fw-bolder text-gray-700 mb-3']) }}
            (%)
            {{ Form::number('discount',  null, ['id'=>'discountId','class' => 'form-control form-control-solid discount', 'min' => 0, 'max' => 100, 'step' => '.01', 'placeholder' => 'In percentage', 'required']) }}
        </div>
    </div>
    <div class="col-md-12">
        <div class="form-group mb-5">
            {{ Form::label('description', __('messages.package.description').(':'),['class' => 'form-label fs-6 fw-bolder text-gray-700 mb-3']) }}
            {{ Form::textarea('description', null, ['class' => 'form-control form-control-solid']) }}
        </div>
    </div>

    {{-- Package Service Dynamic Table layout start --}}

    <div class="col-sm-12">
        <div class="table-responsive-sm">
            <table class="table align-middle table-row-dashed fs-6 gy-5 dataTable no-footer" id="billTbl">
                <thead class="thead-dark">
                <tr class="text-start text-muted fw-bolder fs-7 text-uppercase gs-0">
                    <th class="text-center">#</th>
                    <th class="form-label fw-bolder text-gray-700 mb-3">{{ __('messages.package.service') }}<span
                            class="required"></span></th>
                    <th class="form-label fw-bolder text-gray-700 mb-3">{{ __('messages.package.qty') }}<span
                            class="required"></span></th>
                    <th class="form-label fw-bolder text-gray-700 mb-3">{{ __('messages.package.rate') }}<span
                            class="required"></span></th>
                    <th class="text-right form-label fw-bolder text-gray-700 mb-3">{{ __('messages.package.amount') }}</th>
                    <th class="table__add-btn-heading text-center form-label fw-bolder text-gray-700 mb-3">
                        <button type="button" class="btn btn-sm btn-primary w-100"
                                id="addItem">{{ __('messages.common.add') }}</button>
                    </th>
                </tr>
                </thead>
                <tbody class="package-service-item-container">
                @if(isset($package))
                    @foreach($package->packageServicesItems as $packageServiceItem)
                        <tr>
                            <td class="text-center item-number">{{ $loop->iteration }}</td>
                        <td class="table__item-desc">
                            {{ Form::select('service_id[]', $servicesList, $packageServiceItem->service_id, ['class' => 'form-select form-select-solid select2Selector serviceId','data-control' => 'select2','required', 'placeholder' => __('messages.package.select_service')]) }}
                            {{ Form::hidden('id[]', $packageServiceItem->id) }}
                        </td>
                        <td class="table__qty service-qty">
                            {{ Form::number('quantity[]', $packageServiceItem->quantity, ['class' => 'form-control qty form-control-solid','required']) }}
                        </td>
                        <td class="service-price">
                            {{ Form::text('rate[]', number_format($packageServiceItem->rate), ['class' => 'form-control form-control-solid price-input price','required']) }}
                        </td>
                        <td class="amount text-right item-total">
                            {{ number_format($packageServiceItem->amount) }}
                        </td>
                        <td class="text-center">
                            <a href="#" title="<?php echo __('messages.common.delete') ?>"
                               class="delete-btn delete-service-package-item pointer btn btn-icon btn-bg-light btn-active-color-danger btn-sm">
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
                    <td class="table__item-desc">
                        {{ Form::select('service_id[]', $servicesList, null, ['class' => 'form-select form-select-solid serviceId','required','data-control' => 'select2', 'placeholder' => __('messages.package.select_service')]) }}
                    </td>
                    <td class="table__qty service-qty">
                        {{ Form::number('quantity[]', null, ['class' => 'form-control qty form-control-solid','required']) }}
                    </td>
                    <td class="service-price">
                        {{ Form::text('rate[]', null, ['class' => 'form-control price-input price form-control-solid','required']) }}
                    </td>
                    <td class="amount text-right item-total">
                    </td>
                    <td class="text-center">
                        <a href="#" title="<?php echo __('messages.common.delete') ?>"
                           class="delete-btn delete-service-package-item pointer btn btn-icon btn-bg-light btn-active-color-danger btn-sm">
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
        </div>
        <div class="float-end p-0 mb-3">
            <table>
                <tbody>
                <tr>
                    <td class="font-weight-bold form-label fs-6 fw-bolder text-gray-700 mb-3">{{ __('messages.package.total_amount').(':') }}</td>
                    <td class="font-weight-bold text-right"><b>{{ getCurrencySymbol() }}</b>&nbsp;<span id="total"
                                                                                                        class="price">{{ isset($package) ? number_format($package->total_amount,2) : 0 }}</span>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>

    {{-- Package Service Dynamic Table layout end --}}

<!-- Total Amount Field -->
    {{ Form::hidden('total_amount', null, ['class' => 'form-control', 'id' => 'total_amount']) }}

    <div class="d-flex mt-5">
        {{ Form::submit(__('messages.common.save'), ['class' => 'btn btn-primary me-3', 'id'=>'saveBtn']) }}
        <a href="{{ route('packages.index') }}"
           class="btn btn-light btn-active-light-primary me-2">{{ __('messages.common.cancel') }}</a>
    </div>
</div>
