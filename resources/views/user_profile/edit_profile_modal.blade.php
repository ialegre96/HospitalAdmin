<div class="modal fade" id="editProfileModal" role="dialog" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h2>{{ __('messages.profile.edit_profile') }}</h2>
                <button type="button" aria-label="Close" class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                    <span class="svg-icon svg-icon-1">
						<svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
							<g transform="translate(12.000000, 12.000000) rotate(-45.000000) translate(-12.000000, -12.000000) translate(4.000000, 4.000000)" fill="#000000">
								<rect fill="#000000" x="0" y="7" width="16" height="2" rx="1" />
								<rect fill="#000000" opacity="0.5" transform="translate(8.000000, 8.000000) rotate(-270.000000) translate(-8.000000, -8.000000)" x="0" y="7" width="16" height="2" rx="1" />
							</g>
						</svg>
					</span>
                </button>
            </div>
            {{ Form::open(['class'=>'form','id'=>'editProfileForm','files'=>true]) }}
            <div class="modal-body scroll-y mx-5 mx-xl-15 my-7">
{{--                <div class="alert alert-danger display-none" id="editProfileValidationErrorsBox"></div>--}}
                {{ Form::hidden('user_id',null,['id'=>'editUserId']) }}
                {{csrf_field()}}
                <div class="row">
                    <div class="col-md-6 fv-row mb-7">
                        {{ Form::label('first_name', __('messages.profile.first_name').':', ['class' => 'fs-5 fw-bold mb-2']) }}
                        <span class="required"></span>
                        {{ Form::text('first_name', null, ['id'=>'firstName','class' => 'form-control form-control-solid','required']) }}
                    </div>
                    <div class="col-md-6 fv-row mb-7">
                        {{ Form::label('last_name', __('messages.profile.last_name').':', ['class' => 'fs-5 fw-bold mb-2']) }}<span
                                class="required"></span>
                        {{ Form::text('last_name', null, ['id'=>'lastName','class' => 'form-control form-control-solid','required']) }}
                    </div>
                    <div class="col-md-6 fv-row mb-7">
                        {{ Form::label('email', __('messages.profile.email').':', ['class' => 'fs-5 fw-bold mb-2']) }}
                        <span class="required"></span>
                        {{ Form::email('email', null, ['id'=>'email','class' => 'form-control form-control-solid','required']) }}
                    </div>
                    <div class="col-md-6 fv-row mb-7">
                        {{ Form::label('phone', __('messages.profile.phone').':', ['class' => 'fs-5 fw-bold mb-2']) }}
                        {{ Form::tel('phone', null, ['id'=>'phone','class' => 'form-control form-control-solid', 'onkeyup' => 'if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,"")']) }}
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6 fv-row mb-7">
                        {{ Form::label('image', __('messages.profile.profile').':', ['class' => 'fs-5 fw-bold mb-2 d-block']) }}
                        <div id="empty-image" class="image-input image-input-outline" data-kt-image-input="true">
                            <div class="image-input-wrapper w-125px h-125px" id="editPhoto"></div>

                            <label class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-white shadow"
                                   data-kt-image-input-action="change" data-bs-toggle="tooltip" data-bs-dismiss="click"
                                   title="Change avatar">
                                <i class="bi bi-pencil-fill fs-7"></i>

                                <input type="file" name="image" id="profileImage" accept=".png, .jpg, .jpeg, .gif"/>
                                <input type="hidden" name="avatar_remove"/>
                            </label>

                            <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-white shadow remove-profile-image"
                                  data-kt-image-input-action="cancel" data-bs-toggle="tooltip" data-bs-dismiss="click"
                                  title="Cancel avatar">
         <i class="bi bi-x fs-2"></i>
     </span>
                            <span id="remove-image" class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-white shadow remove-profile-image" data-kt-image-input-action="remove" data-bs-toggle="tooltip" data-bs-dismiss="click" title="Remove avatar">
         <i class="bi bi-x fs-2"></i>
     </span>
                        </div>
                    </div>
                </div>
                <div class="text-right">
                    {{ Form::button(__('messages.common.save'), ['type'=>'submit','class' => 'btn btn-primary me-3','id'=>'btnPrEditSave','data-loading-text'=>"<span class='spinner-border spinner-border-sm'></span> Processing..."]) }}
                    <button type="button" class="btn btn-light btn-active-light-primary"
                            data-bs-dismiss="modal">{{ __('messages.common.cancel') }}
                    </button>
                </div>
            </div>
            {{ Form::close() }}
        </div>
    </div>
</div>

<div id="changeLanguageModal" class="modal fade" role="dialog" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h2>{{ __('messages.profile.change_language')}}</h2>
                <button type="button" aria-label="Close" class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                    <span class="svg-icon svg-icon-1">
						<svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24"
                             version="1.1">
							<g transform="translate(12.000000, 12.000000) rotate(-45.000000) translate(-12.000000, -12.000000) translate(4.000000, 4.000000)" fill="#000000">
								<rect fill="#000000" x="0" y="7" width="16" height="2" rx="1" />
								<rect fill="#000000" opacity="0.5" transform="translate(8.000000, 8.000000) rotate(-270.000000) translate(-8.000000, -8.000000)" x="0" y="7" width="16" height="2" rx="1" />
							</g>
						</svg>
					</span>
                </button>
            </div>
            {{ Form::open(['id'=>'changeLanguageForm']) }}
            <div class="modal-body scroll-y mx-5 mx-xl-15 my-7">
                <div class="alert alert-danger display-none hide" id="editProfileValidationErrorsBox"></div>
                {{csrf_field()}}
                <div class="row">
                    <div class="col-12 fv-row mb-7">
                        {{ Form::label('language',__('messages.profile.language').':', ['class' => 'fs-5 fw-bold mb-2']) }}
                        <span class="required"></span>
                        {{ Form::select('language', \App\Models\User::LANGUAGES, Auth::user()->language, ['id'=>'language','class' => 'form-select form-select-solid','data-control'=>'select2','data-hide-search'=> 'true','data-placeholder'=> 'language','required']) }}
                    </div>
                </div>
                <div class="text-right">
                    {{ Form::button(__('messages.common.save'), ['type'=>'submit','class' => 'btn btn-primary me-3','id'=>'btnLanguageChange','data-loading-text'=>"<span class='spinner-border spinner-border-sm'></span> Processing..."]) }}
                    <button type="button" class="btn btn-light btn-active-light-primary" data-bs-dismiss="modal">{{ __('messages.common.cancel') }}</button>
                </div>
            </div>
            {{ Form::close() }}
        </div>
    </div>
</div>
