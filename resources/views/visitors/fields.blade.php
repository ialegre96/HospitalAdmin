<div class="alert alert-danger display-none hide" id="visitorValidationErrorsBox"></div>
<div class="row">
    <div class="form-group col-sm-6 mb-5">
        {{ Form::label('Name',__('messages.visitor.purpose').':', ['class' => 'form-label fs-6 fw-bolder text-gray-700 mb-3']) }}
        <span
            class="text-danger">*</span>
        {{ Form::select('purpose', $purpose, null, ['class' => 'form-select form-select-solid', 'id' => 'purpose','placeholder' => 'Select Purpose']) }}
    </div>
    <div class="form-group col-sm-6 mb-5">
        {{ Form::label('Name',__('messages.visitor.name').':', ['class' => 'form-label fs-6 fw-bolder text-gray-700 mb-3']) }}
        <span
            class="text-danger">*</span>
        {{ Form::text('name', null, ['class' => 'form-control form-control-solid','required']) }}
    </div>
</div>
<div class="row">
    <div class="form-group col-sm-6 myclass mb-5">
        {{ Form::label('Phone',__('messages.visitor.phone').':', ['class' => 'form-label fs-6 fw-bolder text-gray-700 mb-3']) }}
        {!! Form::tel('phone', null, ['class' => 'form-control form-control-solid','id' => 'phoneNumber', 'onkeyup' => 'if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,"")']) !!}
        {!! Form::hidden('prefix_code',null,['id'=>'prefix_code']) !!}
        <span id="valid-msg" class="hide">✓ &nbsp; Valid</span>
        <span id="error-msg" class="hide"></span>
    </div>
    <div class="form-group col-sm-6 mb-5">
        {{ Form::label('Id Card',__('messages.visitor.id_card').':', ['class' => 'form-label fs-6 fw-bolder text-gray-700 mb-3']) }}
        {{ Form::text('id_card', null, ['class' => 'form-control form-control-solid','id' => 'id_card']) }}
    </div>
</div>
<div class="row">
    <div class="form-group col-sm-6 mb-5">
        {{ Form::label('Number Of Person',__('messages.visitor.number_of_person').':', ['class' => 'form-label fs-6 fw-bolder text-gray-700 mb-3']) }}
        {{ Form::number('no_of_person', null, ['class' => 'form-control form-control-solid','id' => 'no_of_person','min'=>'1']) }}
    </div>
    <div class="form-group col-sm-6 mb-5">
        {{ Form::label('Date',__('messages.visitor.date').':', ['class' => 'form-label fs-6 fw-bolder text-gray-700 mb-3']) }}
        {{ Form::text('date', null, ['class' => 'form-control form-control-solid','autocomplete' => 'off','id' => 'date']) }}
    </div>
</div>
<div class="row">
    <div class="form-group col-sm-6 mb-5">
        {{ Form::label('In Time',__('messages.visitor.in_time').':', ['class' => 'form-label fs-6 fw-bolder text-gray-700 mb-3']) }}
        {{ Form::text('in_time', null, ['class' => 'form-control form-control-solid','id' => 'inTime']) }}
    </div>
    <div class="form-group col-sm-6 mb-5">
        {{ Form::label('Out Time',__('messages.visitor.out_time').':', ['class' => 'form-label fs-6 fw-bolder text-gray-700 mb-3']) }}
        {{ Form::text('out_time', null, ['class' => 'form-control form-control-solid','autocomplete' => 'off','id' => 'outTime']) }}
    </div>
</div>
<div class="row">
    <div class="form-group col-sm-6 mb-5">
        {{ Form::label('Note',__('messages.visitor.note').':', ['class' => 'form-label fs-6 fw-bolder text-gray-700 mb-3']) }}
        {{ Form::textarea('note', null, ['class' => 'form-control form-control-solid','autocomplete' => 'off','id' => 'note','rows' => 5,'cols' => 5]) }}
    </div>
    <div class="col-sm-6 col-md-3 col-lg-2 col-6">
        <div class="form-group mb-5">
            <div class="row2">
                {{ Form::label('attachment', __('messages.expense.attachment').':', ['class' => 'form-label fs-6 fw-bolder text-gray-700 mb-3']) }}
                <div class="image-input image-input-outline" data-kt-image-input="true">
                    <?php
                    $style = 'style=';
                    $background = 'background-image:';
                    ?>
                    <div class="image-input-wrapper w-125px h-125px bgi-position-center" id="previewImage"
                    {{$style}}"{{$background}} url( @if($isEdit)
                        @if($fileExt=='pdf')
                            {{asset('assets/img/pdf.png')}}
                        @elseif($fileExt=='doc' || $fileExt=='docx')
                            {{asset('assets/img/doc.png')}}
                        @else
                            {{ empty($visitor->document_url)?asset('assets/img/default_image.jpg'):$visitor->document_url }}
                        @endif
                    @else
                        {{ asset('assets/img/default_image.jpg') }}
                    @endif)">
                </div>
                    <label class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-white shadow"
                           data-kt-image-input-action="change"
                           data-bs-toggle="tooltip"
                           data-bs-dismiss="click"
                           title="Change attachment">
                        <i class="bi bi-pencil-fill fs-7"></i>

                        <input type="file" name="attachment" id="attachment"
                               accept=".png, .jpg, .jpeg, .gif, .pdf, .doc"/>
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
                    @if($isEdit)
                        @if($visitor->document_url)
                            <span
                                class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-white shadow btn-view"
                                data-bs-toggle="tooltip"
                                data-bs-dismiss="click"
                                title="View attachment">
                                <a href="{{$visitor->document_url}}" class="" target="_blank"><i
                                        class="bi bi-eye-fill fs-6"></i></a>
                            </span>
                        @endif
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
<div class="d-flex mt-5">
    {!! Form::submit(__('messages.common.save'), ['class' => 'btn btn-primary me-3','id' => 'btnSave']) !!}
    <a href="{!! route('visitors.index') !!}"
       class="btn btn-light btn-active-light-primary me-2">{!! __('messages.common.cancel') !!}</a>
</div>
