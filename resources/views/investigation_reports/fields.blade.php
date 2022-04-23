<div class="row gx-10 mb-5">
    <div class="col-md-4">
        <div class="form-group mb-5">
            {{ Form::label('title', __('messages.investigation_report.title').(':'), ['class' => 'form-label fs-6 fw-bolder text-gray-700 mb-3']) }}
            <label
                class="required"></label>
            {{ Form::text('title', null, ['class' => 'form-control form-control-solid','required']) }}
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group mb-5">
            {{ Form::label('patient_id', __('messages.investigation_report.patient').(':'), ['class' => 'form-label fs-6 fw-bolder text-gray-700 mb-3']) }}
            <label
                class="required"></label>
            {{ Form::select('patient_id',$patients, null, ['class' => 'form-select form-select-solid','required','id' => 'patientId','placeholder'=>'Select Patient','data-control' => 'select2']) }}
        </div>
    </div>
    @if(Auth::user()->hasRole('Doctor'))
        <input type="hidden" name="doctor_id" value="{{ Auth::user()->owner_id }}">
    @else
        <div class="col-md-4">
            <div class="form-group mb-5">
                {{ Form::label('doctor_id', __('messages.investigation_report.doctor').(':'), ['class' => 'form-label fs-6 fw-bolder text-gray-700 mb-3']) }}
                <label
                    class="required"></label>
                {{ Form::select('doctor_id',$doctors, null, ['class' => 'form-select form-select-solid','required','id' => 'doctorId','placeholder'=>'Select Doctor','data-control' => 'select2']) }}
            </div>
        </div>
    @endif
    <div class="col-md-4">
        <div class="form-group investigation-report-date mb-5">
            {{ Form::label('date', __('messages.investigation_report.date').(':'), ['class' => 'form-label fs-6 fw-bolder text-gray-700 mb-3']) }}
            <label class="required"></label>
            {{ Form::text('date', null, ['class' => 'form-control form-control-solid','id' => 'date','required','autocomplete' => 'off']) }}
        </div>
    </div>
    <div class="form-group col-md-4 mb-5">
        <div class="row2">
            {{ Form::label('attachment', __('messages.investigation_report.attachment').(':'), ['class' => 'fs-5 fw-bold mb-2 d-block']) }}
            <div class="image-input image-input-outline" data-kt-image-input="true">
                <?php
                $style = 'style=';
                $background = 'background-image:';
                ?>
                <div class="image-input-wrapper w-125px h-125px bgi-position-center" id="previewImage"
                {{$style}}"{{$background}} url({{ asset('assets/img/default_image.jpg') }})">
            </div>

            <label class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-white shadow"
                   data-kt-image-input-action="change"
                   data-bs-toggle="tooltip"
                   data-bs-dismiss="click"
                   title="Change attachment">
                <i class="bi bi-pencil-fill fs-7"></i>

                <input type="file" name="attachment" id="attachment" accept=".png, .jpg, .jpeg, .gif, .pdf, .doc"/>
                <input type="hidden" name="avatar_remove"/>
                </label>

                <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-white shadow"
                      data-kt-image-input-action="cancel"
                      data-bs-toggle="tooltip"
                      data-bs-dismiss="click"
                      title="Cancel attachment">
                        <i class="bi bi-x fs-2"></i>
                </span>
                <span
                    class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-white shadow remove-image"
                    data-kt-image-input-action="remove"
                    data-bs-toggle="tooltip"
                    data-bs-dismiss="click"
                    title="Remove attachment">
                        <i class="bi bi-x fs-2"></i>
                </span>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group mb-5">
            {{ Form::label('status', __('messages.common.status').(':'), ['class' => 'form-label fs-6 fw-bolder text-gray-700 mb-3']) }}
            <span class="required"></span>
            {{ Form::select('status', $status, null, ['id' => 'status','class' => 'form-select form-select-solid','required','data-control' => 'select2']) }}
        </div>
    </div>
    <div class="col-md-12">
        <div class="form-group mb-5">
            {{ Form::label('description', __('messages.investigation_report.description').(':'), ['class' => 'form-label fs-6 fw-bolder text-gray-700 mb-3']) }}
            {{ Form::textarea('description', null, ['class' => 'form-control form-control-solid']) }}
        </div>
    </div>
    <div class="d-flex mt-5">
        {{ Form::submit(__('messages.common.save'), ['class' => 'btn btn-primary me-3']) }}
        <a href="{{ route('investigation-reports.index') }}"
           class="btn btn-light btn-active-light-primary me-2">{{ __('messages.common.cancel') }}</a>
    </div>
</div>
