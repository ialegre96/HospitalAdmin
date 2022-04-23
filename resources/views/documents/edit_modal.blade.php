<div id="EditModal" class="modal fade" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h2>{{ __('messages.document.edit_document') }}</h2>
                <button type="button" aria-label="Close" class="btn btn-sm btn-icon btn-active-color-primary"
                        data-bs-dismiss="modal">
                    <span class="svg-icon svg-icon-1">
						<svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24"
                             version="1.1">
							<g transform="translate(12.000000, 12.000000) rotate(-45.000000) translate(-12.000000, -12.000000) translate(4.000000, 4.000000)"
                               fill="#000000">
								<rect fill="#000000" x="0" y="7" width="16" height="2" rx="1"/>
								<rect fill="#000000" opacity="0.5"
                                      transform="translate(8.000000, 8.000000) rotate(-270.000000) translate(-8.000000, -8.000000)"
                                      x="0" y="7" width="16" height="2" rx="1"/>
							</g>
						</svg>
					</span>
                </button>
            </div>
            {{ Form::open(['id'=>'editForm']) }}
            <div class="modal-body scroll-y mx-5 mx-xl-15 my-7">
                <div class="alert alert-danger display-none hide" id="editDocumentValidationErrorsBox"></div>
                {{ Form::hidden('id',null,['id'=>'documentId']) }}
                <div class="row">
                    <div class="form-group col-sm-6 mb-5">
                        {{ Form::label('title', __('messages.document.title').(':'), ['class' => 'form-label required fs-6 fw-bolder text-gray-700 mb-3']) }}
                        {{ Form::text('title', null, ['class' => 'form-control form-control-solid','required','id' => 'editTitle']) }}
                    </div>
                    <div class="form-group col-sm-6 mb-5">
                        {{ Form::label('document_type', __('messages.document.document_type').(':'), ['class' => 'form-label required fs-6 fw-bolder text-gray-700 mb-3']) }}
                        {{ Form::select('document_type_id', $documentType, null, ['class' => 'form-select form-select-solid','required', 'id' => 'documentTypeId','placeholder' => __('messages.document.select_document_type'), 'data-control' => 'select2', 'id' => 'editDocumentTypeId']) }}
                    </div>
                    @if(getLoggedInUser()->hasRole('Patient'))
                        <input type="hidden" name="patient_id" value="{{ getLoggedInUser()->owner_id }}">
                    @else
                        <div class="form-group col-sm-6 mb-5">
                            <div>
                                {{ Form::label('patient', __('messages.document.patient').(':'), ['class' => 'form-label required fs-6 fw-bolder text-gray-700 mb-3']) }}
                                {{ Form::select('patient_id', $patients, null, ['class' => 'form-select form-select-solid','required', 'id' => 'patientId', 'placeholder' => __('messages.document.select_patient'), 'data-control' => 'select2', 'id' => 'editPatientId']) }}
                            </div>
                        </div>
                    @endif
                    <div class="form-group col-sm-6 mb-5">
                        {{ Form::label('file', __('messages.document.attachment').(':'), ['class' => 'form-label required fs-6 fw-bolder text-gray-700 mb-3']) }}
                        <?php
                        $style = 'style=';
                        $background = 'background-image:';
                        ?>
                        <br>
                        <div class="image-input image-input-outline" data-kt-image-input="true">
                            <div class="image-input-wrapper w-125px h-125px bgi-position-center" id="editPreviewImage"
                            {{$style}}"{{$background}} url('{{ asset('assets/img/default_image.jpg') }}')">
                        </div>
                        <label
                                class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-white shadow"
                                data-kt-image-input-action="change" data-bs-toggle="tooltip" title=""
                                data-bs-original-title="Change attachment">
                            <i class="bi bi-pencil-fill fs-7"></i>
                            {{ Form::file('file',['id'=>'editDocumentImage','class' => 'd-none']) }}
                            <input type="hidden" name="avatar_remove">
                        </label>
                        <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-white shadow"
                                  data-kt-image-input-action="cancel" data-bs-toggle="tooltip" title=""
                                  data-bs-original-title="Cancel attachment">
                                <i class="bi bi-x fs-2"></i>
                            </span>
                            <span
                                class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-white shadow btn-view"
                                data-bs-toggle="tooltip"
                                data-bs-dismiss="click"
                                title="View attachment">
                                <a href="#" id="documentUrl" class="" target="_blank"><i
                                        class="bi bi-eye-fill fs-6"></i></a>
                            </span>
                        </div>
                    </div>
                    <div class="form-group col-sm-12 mb-5">
                        {{ Form::label('notes', __('messages.document.notes').(':'), ['class' => 'form-label fs-6 fw-bolder text-gray-700 mb-3']) }}
                        {{ Form::textarea('notes', null, ['class' => 'form-control form-control-solid', 'id' => 'editNotes', 'rows' => 5]) }}
                    </div>
                </div>
                <div class="text-right mt-5">
                    {{ Form::button(__('messages.common.save'), ['type' => 'submit','class' => 'btn btn-primary me-2','id' => 'btnEditSave','data-loading-text' => "<span class='spinner-border spinner-border-sm'></span> Processing..."]) }}
                    <button type="button" class="btn btn-light btn-active-light-primary me-2"
                            data-bs-dismiss="modal">{{ __('messages.common.cancel') }}</button>
                </div>
            </div>
            {{ Form::close() }}
        </div>
    </div>
</div>
