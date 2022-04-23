<div class="row">
    <!-- Vehicle Number Field -->
    <div class="form-group col-sm-6 mb-5">
        {{ Form::label('vehicle_number', __('messages.ambulance.vehicle_number').(':'),['class' => 'form-label required fs-6 fw-bolder text-gray-700 mb-3']) }}
        {{ Form::text('vehicle_number', null, ['class' => 'form-control form-control-solid','required']) }}
    </div>

    <!-- Vehicle Model Field -->
    <div class="form-group col-sm-6 mb-5">
        {{ Form::label('vehicle_model', __('messages.ambulance.vehicle_model').(':'),['class' => 'form-label required fs-6 fw-bolder text-gray-700 mb-3']) }}
        {{ Form::text('vehicle_model', null, ['class' => 'form-control form-control-solid','required']) }}
    </div>

    <!-- Year Made Field -->
    <div class="form-group col-sm-6 mb-5">
        {{ Form::label('year_made', __('messages.ambulance.year_made').(':'),['class' => 'form-label required fs-6 fw-bolder text-gray-700 mb-3']) }}
        {{ Form::text('year_made', null, ['class' => 'form-control form-control-solid','required','onkeyup' => 'if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,"")']) }}
    </div>

    <!-- Driver Name Field -->
    <div class="form-group col-sm-6 mb-5">
        {{ Form::label('driver_name', __('messages.ambulance.driver_name').(':'),['class' => 'form-label required fs-6 fw-bolder text-gray-700 mb-3']) }}
        {{ Form::text('driver_name', null, ['class' => 'form-control form-control-solid','required']) }}
    </div>

    <!-- Driver Contact Field -->
    <div class="form-group col-sm-6 mb-5">
        {{ Form::label('driver_contact', __('messages.ambulance.driver_contact').(':'),['class' => 'form-label required fs-6 fw-bolder text-gray-700 mb-3']) }}
        <br>
        {{ Form::tel('driver_contact', null, ['class' => 'form-control form-control-solid','id' => 'phoneNumber', 'onkeyup' => 'if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,"")','required']) }}
        {{ Form::hidden('prefix_code',null,['id'=>'prefix_code']) }}
        <span id="valid-msg" class="hide">✓ &nbsp; Valid</span>
        <span id="error-msg" class="hide"></span>
    </div>

    <!-- Driver License Field -->
    <div class="form-group col-sm-6 mb-5">
        {{ Form::label('driver_license', __('messages.ambulance.driver_license').(':'),['class' => 'form-label required fs-6 fw-bolder text-gray-700 mb-3']) }}
        {{ Form::text('driver_license', null, ['class' => 'form-control form-control-solid','required']) }}
    </div>

    <!-- Note Field -->
    <div class="form-group col-sm-6 mb-5">
        {{ Form::label('note', __('messages.ambulance.note').(':'),['class' => 'form-label fs-6 fw-bolder text-gray-700 mb-3']) }}
        {{ Form::textarea('note', null, ['class' => 'form-control form-control-solid','rows'=>'2']) }}
    </div>
    <div class="form-group col-sm-6 mb-5">
        {{ Form::label('vehicle_type', __('messages.ambulance.vehicle_type').(':'),['class' => 'form-label required fs-6 fw-bolder text-gray-700 mb-3']) }}
        {{ Form::select('vehicle_type', $type,null, ['id'=>'vehicleType','class' => 'form-select form-select-solid','required','data-control' => 'select2']) }}
    </div>
    <div class="col-md-3 mb-3">
        {{ Form::label('is_available',__('messages.common.is_available').(':'),['class' => 'form-label fs-6 fw-bolder text-gray-700 mb-3']) }}
        <br>
        <div class="form-check form-switch form-check-custom form-check-solid">
            <input class="form-check-input w-35px h-20px is-active" name="is_available" type="checkbox" value="1"
                   checked>
        </div>
    </div>

    <!-- Submit Field -->
    <div class="d-flex mt-5">
        {{ Form::submit(__('messages.common.save'), ['class' => 'btn btn-primary me-3', 'id' => 'btnSave']) }}
        <a href="{{ route('ambulances.index') }}"
           class="btn btn-light btn-active-light-primary me-2">{{ __('messages.common.cancel') }}</a>
    </div>
</div>
