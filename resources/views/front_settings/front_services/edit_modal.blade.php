<div id="editModal" class="modal fade" role="dialog" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h2>{{ __('messages.front_services.edit_service') }}</h2>
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
            {{ Form::open(['id'=>'editForm','files' => true]) }}
            <div class="modal-body scroll-y mx-5 mx-xl-15 my-7">
                <div class="alert alert-danger display-none hide" id="editValidationErrorsBox"></div>
                <div class="row">
                    {{ Form::hidden('id',null,['id'=>'frontServiceId']) }}
                    <div class="form-group col-sm-12 mb-5">
                        {{ Form::label('name', __('messages.common.name').(':'), ['class' => 'form-label required fs-6 fw-bolder text-gray-700 mb-3']) }}
                        {{ Form::text('name', null, ['class' => 'form-control form-control-solid','id' => 'editName','required']) }}
                    </div>
                    <div class="form-group col-sm-12 mb-5">
                        {{ Form::label('short_description', __('messages.short_description').(':'),['class' => 'form-label required fs-6 fw-bolder text-gray-700 mb-3']) }}
                        {{ Form::textarea('short_description', null, ['class' => 'form-control form-control-solid','id' => 'editDescription','rows' => 6]) }}
                    </div>
                    <div class="form-group col-sm-12 mb-5">
                        <label class="form-label required fs-6 fw-bolder text-gray-700 mb-3" for="file"> <span>{{__('messages.icon')}}: </span>
                            <i class="fa fa-question-circle ms-1 fs-7" data-bs-toggle="tooltip"
                               title="Best resolution for this icon will be 65x65"></i>
                        </label>
                        <br>
                        <div class="image-input image-input-outline" data-kt-image-input="true">
                            <?php
                            $style = 'style=';
                            $background = 'background-image:';
                            ?>
                            <div class="image-input-wrapper w-125px h-125px bgi-position-center" id="editPreviewImage"
                            {{$style}}"{{$background}} url({{ asset('web_front/images/services/medicine.png') }})">
                        </div>
                        <label
                                class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-white shadow"
                                data-kt-image-input-action="change" data-bs-toggle="tooltip" title=""
                                data-bs-original-title="Change icon">
                            <i class="bi bi-pencil-fill fs-7"></i>
                            {{ Form::file('icon',['id'=>'editIcon','class' => 'd-none document-file']) }}
                            <input type="hidden" name="avatar_remove">
                        </label>
                        <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-white shadow"
                                  data-kt-image-input-action="cancel" data-bs-toggle="tooltip" title=""
                                  data-bs-original-title="Cancel icon">
                                <i class="bi bi-x fs-2"></i>
                            </span>
                            <span
                                    class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-white shadow btn-view"
                                    data-bs-toggle="tooltip"
                                    data-bs-dismiss="click" title="View icon">
                                <a href="#" id="iconUrl" class="" target="_blank"><i
                                            class="bi bi-eye-fill fs-6"></i></a>
                            </span>
                        </div>
                        <div class="form-text">Allowed file types: png, jpg, jpeg.</div>
                    </div>
                </div>
                <div class="text-right mt-5">
                    {{ Form::button(__('messages.common.save'), ['type' => 'submit','class' => 'btn btn-primary me-3','id' => 'btnEditSave','data-loading-text' => "<span class='spinner-border spinner-border-sm'></span> Processing..."]) }}
                    <button type="button" class="btn btn-light btn-active-light-primary me-2"
                            data-bs-dismiss="modal">{{ __('messages.common.cancel') }}</button>
                </div>
            </div>
            {{ Form::close() }}
        </div>
    </div>
</div>


