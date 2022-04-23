<div id="showModal" class="modal fade" role="dialog" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h2>{{ __('messages.testimonial.show_testimonial') }}</h2>
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
            </div>
            <div class="modal-body scroll-y mx-5 mx-xl-15 my-7">
                <div class="alert alert-danger display-none hide" id="editValidationErrorsBox"></div>
                <div class="row">
                    <div class="form-group col-sm-12 mb-5">
                        <label class="form-label fs-6 fw-bolder text-gray-700 mb-3">{{__('messages.testimonial.name').':'}}</label>
                        <span class="show-name"></span>
                    </div>
                    <div class="form-group col-sm-12 mb-5">
                        <label class="form-label fs-6 fw-bolder text-gray-700 mb-3">{{__('messages.testimonial.position').':'}}</label>
                        <span class="show-position"></span>
                    </div>
                    <div class="form-group col-sm-12 mb-5">
                        <label class="form-label fs-6 fw-bolder text-gray-700 mb-3">{{__('messages.testimonial.description').':'}}</label>
                        <span class="show-description"></span>
                    </div>
                    <div class="form-group col-sm-12 mb-5">
                        <label class="form-label fs-6 fw-bolder text-gray-700 mb-3" for="file"> <span>{{__('messages.common.profile')}}: </span>
                        </label>
                        <?php
                        $style = 'style=';
                        $background = 'background-image:';
                        ?>
                        <br>
                        <div class="image-input image-input-outline" data-kt-image-input="true">
                            <div class="image-input-wrapper w-125px h-125px bgi-position-center"
                                 id="showPreviewImage" {{$style}}"{{$background}}
                            url({{ asset('assets/img/default_image.jpg') }})">
                        </div>
                        <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-white shadow"
                              data-kt-image-input-action="cancel" data-bs-toggle="tooltip" title=""
                              data-bs-original-title="Cancel profile">
                                <i class="bi bi-x fs-2"></i>
                            </span>
                        <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-white shadow btn-view"
                              data-bs-toggle="tooltip" data-bs-dismiss="click" title="View profile">
                                <a href="#" id="documentUrl" class="" target="_blank"><i
                                            class="bi bi-eye-fill fs-6"></i></a>
                            </span>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </div>
</div>


