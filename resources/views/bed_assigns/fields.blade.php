<div class="row gx-10 mb-5">
    <div class="col-sm-6">
        <div class="mb-5">
            {{ Form::label('case_id', __('messages.case.case').':', ['class' => 'form-label required fs-6 fw-bolder text-gray-700 mb-3']) }}
            {{ Form::select('case_id', $cases, null, ['class' => 'form-select form-select-solid fw-bold', 'required', 'id' => 'caseId', 'placeholder' => 'Select Case', 'data-control' => 'select2', isset($bedAssign->case_id) ? 'disabled' : '']) }}
            @if(isset($bedAssign->case_id))
                {{Form::hidden('case_id',$bedAssign->case_id)}}
            @endif
        </div>
    </div>
    <div class="col-sm-6">
        <div class="mb-5">
            {{ Form::label('ipd_patient_department_id', __('messages.ipd_patient.ipd_patient').':', ['class' => 'form-label fs-6 fw-bolder text-gray-700 mb-3']) }}
            {{ Form::select('ipd_patient_department_id', [null], null, ['class' => 'form-select form-select-solid fw-bold', 'required', 'id' => 'ipdPatientId', 'disabled', 'data-control' => 'select2', 'placeholder' => 'Select IPD Patient']) }}
        </div>
    </div>
    <div class="col-sm-6">
        <div class="mb-5">
            {{ Form::label('bed_id', __('messages.bed_assign.bed').':', ['class' => 'form-label required fs-6 fw-bolder text-gray-700 mb-3']) }}
            {{ Form::select('bed_id', $beds, isset($bedId) ? $bedId : null, ['class' => 'form-select form-select-solid fw-bold', 'required', 'id' => 'bedId', 'data-control' => 'select2', 'placeholder' => 'Select Bed']) }}
        </div>
    </div>
    <div class="col-sm-6">
        <div class="mb-5">
            {{ Form::label('assign_date', __('messages.bed_assign.assign_date').':', ['class' => 'form-label required fs-6 fw-bolder text-gray-700 mb-3']) }}
            {{ Form::text('assign_date', null, ['class' => 'form-control form-control-solid','id' => 'assignDate', 'required']) }}
        </div>
    </div>
    @isset($bedAssign)
        <div class="col-sm-6">
            <div class="mb-5">
                {{ Form::label('discharge_date', __('messages.bed_assign.discharge_date').':', ['class' => 'form-label fs-6 fw-bolder text-gray-700 mb-3']) }}
                {{ Form::text('discharge_date', null, ['class' => 'form-control form-control-solid','id' => 'dischargeDate']) }}
            </div>
        </div>
    @endisset
    <div class="col-sm-6">
        <div class="mb-5">
            {{ Form::label('description', __('messages.bed_assign.description').':', ['class' => 'form-label fs-6 fw-bolder text-gray-700 mb-3']) }}
            {{ Form::textarea('description', null, ['class' => 'form-control form-control-solid', 'rows' => 4]) }}
        </div>
    </div>
    <div class="col-sm-6">
        <div class="mb-5">
            {{ Form::label('status', __('messages.common.status').':', ['class' => 'form-label fs-6 fw-bolder text-gray-700 mb-3']) }}
            <div class="form-check form-switch form-check-custom form-check-solid">
                <input class="form-check-input w-35px h-20px switch-input is-active" name="status" type="checkbox"
                       value="1" {{ (isset($bedAssign) && $bedAssign->status === 1) ? 'checked' : '' }} {{ !isset($bedAssign) ? 'checked' : '' }}>
            </div>
        </div>
    </div>
</div>
<div class=" d-flex">
{{ Form::submit(__('messages.common.save'), ['class' => 'btn btn-primary me-2','id' => 'saveBtn']) }}
<a href="{{ route('bed-assigns.index') }}"
   class="btn btn-light btn-active-light-primary me-2">{{ __('messages.common.cancel') }}</a>
</div>
