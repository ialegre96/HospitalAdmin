<div class="col-sm-12">
    <div class="table-responsive-sm">
        <table class="table align-middle table-row-dashed fs-6 gy-5 dataTable no-footer" id="bulkBedsTbl">
            <thead class="thead-dark">
            <tr class="text-start text-muted fw-bolder fs-7 text-uppercase gs-0">
                <th class="text-center">#</th>
                <th>{{ __('messages.bed_assign.bed')}}<span class="required"></span></th>
            <th>{{ __('messages.bed.bed_type') }}<span class="required"></span></th>
            <th>{{ __('messages.bed.charge') }}<span class="required"></span></th>
            <th>{{ __('messages.bed.description') }}</th>
                <th class="table__add-btn-heading text-center">
                    <button type="button" class="btn btn-sm btn-primary w-100"
                            id="addItem">{{ __('messages.bed.add') }}</button>
                </th>
            </tr>
            </thead>
            <tbody class="bulk-beds-item-container text-gray-600 fw-bold">
            <tr>
                <td class="text-center item-number">1</td>
                <td class="name">
                    {{ Form::text('name[]', null, ['class' => 'form-control bedName form-control-solid', 'required']) }}
            </td>
            <td class="bed_type">
                {{ Form::select('bed_type[]', $bedTypes, null, ['class' => 'form-select bedType form-select-solid fw-bold', 'id' => 'bedType', 'required', 'placeholder'=>'Select Bed Type']) }}
            </td>
            <td class="rate">
                {{ Form::text('charge[]', null, ['class' => 'form-control charge price-input form-control-solid','required']) }}
            </td>
            <td>
                {{ Form::textarea('description[]', null, ['class' => 'form-control description form-control-solid','rows' => 1]) }}
            </td>
                <td class="text-center">
                    <a href="#" title="{{__('messages.common.delete')}}"  class="delete-btn delete-invoice-item pointer btn btn-icon btn-bg-light btn-active-color-primary btn-sm">
                    <span class="svg-icon svg-icon-3">
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                        <rect x="0" y="0" width="24" height="24" />
                        <path d="M6,8 L6,20.5 C6,21.3284271 6.67157288,22 7.5,22 L16.5,22 C17.3284271,22 18,21.3284271 18,20.5 L18,8 L6,8 Z" fill="#000000" fill-rule="nonzero" />
                        <path d="M14,4.5 L14,4 C14,3.44771525 13.5522847,3 13,3 L11,3 C10.4477153,3 10,3.44771525 10,4 L10,4.5 L5.5,4.5 C5.22385763,4.5 5,4.72385763 5,5 L5,5.5 C5,5.77614237 5.22385763,6 5.5,6 L18.5,6 C18.7761424,6 19,5.77614237 19,5.5 L19,5 C19,4.72385763 18.7761424,4.5 18.5,4.5 L14,4.5 Z" fill="#000000" opacity="0.3" /></g></svg></span>
                    </a>
                </td>
            </tr>
            </tbody>
        </table>
    </div>
    <div class="form-group col-sm-12 form-buttons bedBtn">
        {{ Form::submit(__('messages.common.save'), ['class' => 'btn btn-primary me-2']) }}
        <a href="{{ route('beds.index') }}"
           class="btn btn-light btn-active-light-primary me-2">{{ __('messages.common.cancel') }}</a>
    </div>
