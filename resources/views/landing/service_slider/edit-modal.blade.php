<div class="modal fade" tabindex="-1" id="editModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{__('messages.service_slider.edit_service_slider')}}</h5>

                <!--begin::Close-->
                <button type="button" aria-label="Close" class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                    <span class="svg-icon svg-icon-1">
						<svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
							<g transform="translate(12.000000, 12.000000) rotate(-45.000000) translate(-12.000000, -12.000000) translate(4.000000, 4.000000)" fill="#000000">
								<rect fill="#000000" x="0" y="7" width="16" height="2" rx="1"/>
								<rect fill="#000000" opacity="0.5" transform="translate(8.000000, 8.000000) rotate(-270.000000) translate(-8.000000, -8.000000)" x="0" y="7" width="16" height="2" rx="1"/>
							</g>
						</svg>
					</span>
                </button>
                <!--end::Close-->
            </div>

            <div class="modal-body">
                {{ Form::open(['id' => 'serviceSliderEditForm', 'files' => true]) }}
                <div class="row">
                    <div class="alert alert-danger display-none hide" id="editDocumentValidationErrorsBox"></div>
                    <input type="hidden" id="serviceId" name="serviceId">
                    <div class="form-group col-sm-6 mb-5">
                        <?php
                        $style = 'style=';
                        $background = 'background-image:';
                        ?>
                        <div class="row2">
                            <label class="form-label required fs-6 fw-bolder text-gray-700 mb-3 d-block"
                                   for="about_us_image">
                                <span>{{__('messages.service_slider.edit_service_slider')}}: </span>
                                <i class="fa fa-question-circle ms-1 fs-7" data-bs-toggle="tooltip"
                                   title="{{__('messages.service_slider.img_tooltip_text')}}"></i>
                            </label>
                            <div id="editInputImage" class="image-input image-input-outline" data-kt-image-input="true">
                                <div class="image-input-wrapper w-125px h-125px bgi-position-center"
                                     id="previewEditImage"
                                {{$style}}"{{$background}}
                                url('{{ asset('web_front/images/main-banner/banner-one/woman-doctor.png') }}')">
                            </div>
                            <label class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-white shadow"
                                   data-kt-image-input-action="change" data-bs-toggle="tooltip" title=""
                                   data-bs-original-title="Change image">
                                <i class="bi bi-pencil-fill fs-7"></i>
                                {{ Form::file('img_url',['id'=>'editServiceImage','class' => 'd-none','accept' => '.png, .jpg, .jpeg, .svg']) }}
                                <input type="hidden" name="avatar_remove">
                            </label>
                            <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-white shadow"
                                  data-kt-image-input-action="cancel" data-bs-toggle="tooltip" title=""
                                  data-bs-original-title="Cancel image">
                                    <i class="bi bi-x fs-2"></i></span>
                        </div>
                    </div>
                    <div class="form-text">{{__('messages.common.allow_img_text')}}</div>
                </div>
            </div>
            <div class="text-right mt-5">
                <button type="submit" class="btn btn-primary me-3"
                        id="btnEditSave">{{__('messages.common.save')}}</button>
                <button type="button" class="btn btn-light btn-active-light-primary me-2"
                        data-bs-dismiss="modal">{{__('messages.common.cancel')}}</button>
            </div>
            {{ Form::close() }}
        </div>
    </div>
</div>
</div>
