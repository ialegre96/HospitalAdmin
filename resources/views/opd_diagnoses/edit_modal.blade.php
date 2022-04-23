<div id="EditModal" class="modal fade" role="dialog" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h2>{{ __('messages.ipd_patient_diagnosis.edit_ipd_diagnosis') }}</h2>
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
                <div class="alert alert-danger display-none hide" id="editValidationErrorsBox"></div>
                {{ Form::hidden('id',null,['id'=>'opdDiagnosisId']) }}
                <div class="row">
                    <div class="form-group col-sm-12 mb-5">
                        {{ Form::label('report_type', __('messages.ipd_patient_diagnosis.report_type').':',['class' => 'form-label required fs-6 fw-bolder text-gray-700 mb-3']) }}
                        {{ Form::text('report_type', null, ['class' => 'form-control form-control-solid','required', 'id' => 'editReportType']) }}
                    </div>
                    <div class="form-group col-md-12 mb-5">
                        {{ Form::label('report_date', __('messages.ipd_patient_diagnosis.report_date').':',['class' => 'form-label required fs-6 fw-bolder text-gray-700 mb-3']) }}
                        {{ Form::text('report_date', null, ['class' => 'form-control form-control-solid','id' => 'editReportDate','autocomplete' => 'off', 'required']) }}
                    </div>
                    <div class="form-group col-md-12 mb-5">
                        <div class="form-group">
                            {{ Form::label('description', __('messages.ipd_patient_diagnosis.description').':',['class' => 'form-label fs-6 fw-bolder text-gray-700 mb-3']) }}
                            {{ Form::textarea('description', null, ['class' => 'form-control form-control-solid', 'rows' => 4, 'id' => 'editDescription']) }}
                        </div>
                    </div>
                    <div class="form-group col-sm-12 mb-5">
                        <div class="row2">
                            {{ Form::label('document', __('messages.ipd_patient_diagnosis.document').':',['class' => 'fs-5 fw-bolder text-gray-600 mb-2 d-block']) }}
                            <div class="image-input image-input-outline" data-kt-image-input="true">
                                <?php
                                $style = 'style=';
                                $background = 'background-image:';
                                ?>
                                <div class="image-input-wrapper w-125px h-125px bgi-position-center"
                                     id="editPreviewImage"
                                {{$style}}"{{$background}} url({{ asset('assets/img/default_image.jpg') }})">
                            </div>
                            <label
                                    class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-white shadow"
                                    data-kt-image-input-action="change"
                                    data-bs-toggle="tooltip"
                                    data-bs-dismiss="click"
                                    title="Change document">
                                <i class="bi bi-pencil-fill fs-7"></i>
                                <input type="file" name="file" id="editDocumentImage"
                                       accept=".png, .jpg, .jpeg, .gif, .pdf, .doc" class="d-none document-file"/>
                                <input type="hidden" name="avatar_remove"/>
                                </label>

                                <span
                                    class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-white shadow"
                                    data-kt-image-input-action="cancel"
                                    data-bs-toggle="tooltip"
                                    data-bs-dismiss="click"
                                    title="Cancel document">
                                    <i class="bi bi-x fs-2"></i>
                                </span>
                                <span
                                    class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-white shadow remove-image-edit"
                                    data-kt-image-input-action="remove"
                                    data-bs-toggle="tooltip"
                                    data-bs-dismiss="click"
                                    title="Remove document">
                                    <i class="bi bi-x fs-2"></i>
                                </span>
                                <span
                                    class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-white shadow btn-view"
                                    data-bs-toggle="tooltip"
                                    data-bs-dismiss="click"
                                    title="View document">
                                <a href="#" id="documentUrl" class="" target="_blank"><i
                                        class="bi bi-eye-fill fs-6"></i></a>
                            </span>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex mt-5">
                        {{ Form::button(__('messages.common.save'), ['type'=>'submit','class' => 'btn btn-primary me-3','id'=>'btnEditSave','data-loading-text'=>"<span class='spinner-border spinner-border-sm'></span> Processing..."]) }}
                        <button type="button" id="btnCancelEdit" class="btn btn-light btn-active-light-primary me-2"
                                data-bs-dismiss="modal">{{ __('messages.common.cancel') }}</button>
                    </div>
                </div>
            </div>
            {{ Form::close() }}
        </div>
    </div>
</div>
