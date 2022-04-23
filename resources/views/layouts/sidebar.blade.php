{{--<link href="{{ mix('assets/css/style.css') }}" rel="stylesheet" type="text/css"/>--}}
@php
    $settingValue = getSuperAdminSettingValue();
    $hospitalSettingValue = getSettingValue();
@endphp
<div id="kt_aside" class="aside aside-dark aside-hoverable sidebar-font-size" data-kt-drawer="true"
     data-kt-drawer-name="aside" data-kt-drawer-activate="{default: true, lg: false}" data-kt-drawer-overlay="true"
     data-kt-drawer-width="{default:'200px', '300px': '250px'}" data-kt-drawer-direction="start"
     data-kt-drawer-toggle="#kt_aside_mobile_toggle">
    <!--begin::Brand-->
    <div class="aside-logo flex-column-auto h-75px" id="kt_aside_logo">
        <!--begin::Logo-->
        <a href="{{ url('/') }}" data-toggle="tooltip" data-placement="right" class="d-flex align-items-center"
           title="{{ getAppName() }}">
            <img class="navbar-brand-minimized h-60px  logo me-5"
                 src="{{ !getLoggedInUser()->hasRole('Super Admin') ? asset($hospitalSettingValue['app_logo']['value']) : asset($settingValue['app_logo']['value']) }}"
                 alt="Logo"/>
            <span class="navbar-brand-name text-white logo">{{ getAppName() }}</span>
        </a>
        <!--end::Logo-->

        <!--begin::Aside toggler-->
        <div id="kt_aside_toggle"
             class="btn btn-icon w-auto px-0 btn-active-color-primary aside-toggle sidebar-aside-toggle"
             data-kt-toggle="true" data-kt-toggle-state="active" data-kt-toggle-target="body"
             data-kt-toggle-name="aside-minimize">
            <!--begin::Svg Icon | path: icons/duotone/Navigation/Angle-double-left.svg-->
            <span class="svg-icon svg-icon-1 rotate-180">
				<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"
                     height="24px" viewBox="0 0 24 24" version="1.1">
					<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
						<polygon points="0 0 24 0 24 24 0 24"/>
						<path d="M5.29288961,6.70710318 C4.90236532,6.31657888 4.90236532,5.68341391 5.29288961,5.29288961 C5.68341391,4.90236532 6.31657888,4.90236532 6.70710318,5.29288961 L12.7071032,11.2928896 C13.0856821,11.6714686 13.0989277,12.281055 12.7371505,12.675721 L7.23715054,18.675721 C6.86395813,19.08284 6.23139076,19.1103429 5.82427177,18.7371505 C5.41715278,18.3639581 5.38964985,17.7313908 5.76284226,17.3242718 L10.6158586,12.0300721 L5.29288961,6.70710318 Z" fill="#000000" fill-rule="nonzero" transform="translate(8.999997, 11.999999) scale(-1, 1) translate(-8.999997, -11.999999)" />
						<path d="M10.7071009,15.7071068 C10.3165766,16.0976311 9.68341162,16.0976311 9.29288733,15.7071068 C8.90236304,15.3165825 8.90236304,14.6834175 9.29288733,14.2928932 L15.2928873,8.29289322 C15.6714663,7.91431428 16.2810527,7.90106866 16.6757187,8.26284586 L22.6757187,13.7628459 C23.0828377,14.1360383 23.1103407,14.7686056 22.7371482,15.1757246 C22.3639558,15.5828436 21.7313885,15.6103465 21.3242695,15.2371541 L16.0300699,10.3841378 L10.7071009,15.7071068 Z" fill="#000000" fill-rule="nonzero" opacity="0.5" transform="translate(15.999997, 11.999999) scale(-1, 1) rotate(-270.000000) translate(-15.999997, -11.999999)" />
					</g>
				</svg>
			</span>
            <!--end::Svg Icon-->
        </div>
        <!--end::Aside toggler-->
    </div>
    <!--end::Brand-->
    <div class="aside-menu flex-column-fluid">
        <div class="hover-scroll-overlay-y" data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-height="auto" data-kt-scroll-dependencies="#kt_aside_logo, #kt_aside_footer" data-kt-scroll-wrappers="#kt_aside_menu" data-kt-scroll-offset="0">
            <!--begin:Search-->
{{--            <div class="wrap">--}}
{{--                <div class="position-relative px-4">--}}
{{--                    <input type="text" class="form-control form-control-solid ps-10" id="searchText" placeholder="Search Menu" autocomplete="off" />--}}
{{--                    <!--begin::Svg Icon | path: icons/duotone/General/Search.svg-->--}}
{{--                    <span class="searchButton svg-icon svg-icon-3 svg-icon-gray-500 position-absolute top-50 translate-middle ms-6">--}}
{{--                         <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">--}}
{{--                             <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">--}}
{{--                                 <rect x="0" y="0" width="24" height="24" />--}}
{{--                                 <path d="M14.2928932,16.7071068 C13.9023689,16.3165825 13.9023689,15.6834175 14.2928932,15.2928932 C14.6834175,14.9023689 15.3165825,14.9023689 15.7071068,15.2928932 L19.7071068,19.2928932 C20.0976311,19.6834175 20.0976311,20.3165825 19.7071068,20.7071068 C19.3165825,21.0976311 18.6834175,21.0976311 18.2928932,20.7071068 L14.2928932,16.7071068 Z" fill="#000000" fill-rule="nonzero" opacity="0.3" />--}}
{{--                                 <path d="M11,16 C13.7614237,16 16,13.7614237 16,11 C16,8.23857625 13.7614237,6 11,6 C8.23857625,6 6,8.23857625 6,11 C6,13.7614237 8.23857625,16 11,16 Z M11,18 C7.13400675,18 4,14.8659932 4,11 C4,7.13400675 7.13400675,4 11,4 C14.8659932,4 18,7.13400675 18,11 C18,14.8659932 14.8659932,18 11,18 Z" fill="#000000" fill-rule="nonzero" />--}}
{{--                             </g>--}}
{{--                         </svg>--}}
{{--                    </span>--}}
{{--                    <!--end::Svg Icon-->--}}
{{--                </div>--}}
{{--                <div class="no-results">No matching records found</div>--}}
{{--            </div>--}}
            <!--end:Search-->
            <div class="menu menu-column menu-title-gray-800 menu-state-title-primary menu-state-icon-primary menu-state-bullet-primary menu-arrow-gray-500" id="#kt_aside_menu" data-kt-menu="true">
                @include('layouts.menu')
            </div>
        </div>
    </div>
</div>

