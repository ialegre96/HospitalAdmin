@php
    $notifications = getNotification(Auth::user()->roles->pluck('name')->first());
    $notificationCount = count($notifications);
    $settingValue = getSuperAdminSettingValue();
@endphp
<?php
$style = 'style=';
$background = 'background-color:';
$margin = 'margin-left:';
?>
<div id="kt_header" class="header align-items-stretch">
    <div class="container-fluid d-flex align-items-stretch justify-content-between">
        <div class="d-flex align-items-center d-lg-none ms-n3 me-1" title="Show aside menu">
            <div class="btn btn-icon btn-active-color-white" id="kt_aside_mobile_toggle">
                <i class="bi bi-list fs-1"></i>
            </div>
        </div>
        <div class="d-flex align-items-center flex-grow-1 flex-lg-grow-0">
            <a href="{{ url('/') }}" class="d-lg-none" title="{{ getAppName() }}">
                <img alt="Logo"
                     src="{{ !getLoggedInUser()->hasRole('Super Admin') ? getLogoUrl() : $settingValue['app_logo']['value'] }}"
                     class="h-15px">
            </a>
        </div>
        <div class="d-flex align-items-stretch justify-content-between flex-lg-grow-1">
            <div class="d-flex align-items-stretch" id="kt_header_nav">
                <div class="header-menu align-items-stretch" data-kt-drawer="true" data-kt-drawer-name="header-menu"
                     data-kt-drawer-activate="{default: true, lg: false}" data-kt-drawer-overlay="true"
                     data-kt-drawer-width="{default:'200px', '300px': '250px'}" data-kt-drawer-direction="end"
                     data-kt-drawer-toggle="#kt_header_menu_mobile_toggle" data-kt-swapper="true"
                     data-kt-swapper-mode="prepend"
                     data-kt-swapper-parent="{default: '#kt_body', lg: '#kt_header_nav'}">
                    @include('layouts.sub_menu')
                </div>
            </div>
            @if(getLoggedInUser()->hasRole('Admin'))
                <div class="d-flex {{ getLoggedInUser()->language == 'ar' ? 'hospital-preview' : 'ms-auto' }} ">
                    <div class="d-flex align-items-stretch hospital-preview-logo">
                        <a href="{{ route('front', getLoggedInUser()->username) }}"
                           class="align-self-center align-items-stretch" target="_blank">
                            <i class="fas fa-globe-americas fs-3 text-primary"></i>
                        </a>
                    </div>
                </div>
            @endif
            <div class="d-flex">
                <div class="d-flex align-items-stretch">
                    <div class="d-flex align-items-stretch">
                        <div class="topbar-item position-relative p-8 d-flex align-items-center hoverable"
                             data-kt-menu-trigger="click" data-kt-menu-attach="parent"
                             data-kt-menu-placement="bottom-end" data-kt-menu-flip="bottom" style="padding-right: 0px !important;">
                            <div class="card-toolbar" data-bs-toggle="tooltip" data-bs-placement="bottom"
                                 data-bs-trigger="hover" title=""
                                 data-bs-original-title="{{ getLoggedInUser()->theme_mode ? 'Switch to Light Mode' : 'Switch to Dark Mode' }}">
                                <a href="{{ route('theme.mode') }}"> <i
                                            class="fas user-check-icon {{ getLoggedInUser()->theme_mode ? 'fa-sun' : 'fa-moon' }} fs-3"></i>
                                </a></div>
                        </div>
                    </div>
                    <div class="topbar-item position-relative p-8 d-flex align-items-center hoverable"
                         data-kt-menu-trigger="click" data-kt-menu-attach="parent"
                         data-kt-menu-placement="bottom-{{ getLoggedInUser()->language == 'ar' ? 'start' : 'end' }}"
                         data-kt-menu-flip="bottom">
                        <i class="far fa-bell fs-3"></i>
                        @if(count(getNotification(Auth::user()->roles->pluck('name')->first())) != 0)
                            <span
                                    class="badge navbar-badge bg-primary notification-count notification-message-counter rounded-circle position-absolute translate-middle d-flex justify-content-center align-items-center {{($notificationCount > 9)?'end-0':'counter-0'}}"
                                    id="counter">{{ count(getNotification(Auth::user()->roles->pluck('name')->first())) }}</span>
                        @endif
                    </div>
                    <div class="menu menu-sub menu-sub-dropdown menu-column w-350px w-lg-375px overflow-auto h-400px"
                         data-kt-menu="true">
                        <div class="d-flex justify-content-between bgi-no-repeat rounded-top sticky-top" {{$style}}
                        "{{$background}}#009ef7">
                        <h3 class="text-white fw-bold px-9 mt-7 mb-5">{{__('messages.notification.notifications')}}
                            <span class="fs-8 opacity-75 ps-3 text-right" {{$style}}"{{$margin}} 90px;">
                            <a href="#" class="read-all-notification text-white" id="readAllNotification">
                                {{ __('messages.notification.mark_all_as_read') }}</a>
                            </span>
                        </h3>
                    </div>
                    <div class="dropdown-list-content dropdown-list-icons force-scroll">
                        @if($notificationCount > 0)
                            @foreach($notifications as $notification)
                            <a href="#" data-id="{{ $notification->id }}"
                               class="notification text-hover-primary" id="notification">
                                        <div class="scroll-y mh-325px my-5 px-5">
                                            <div class="d-flex flex-stack py-4">
                                                <div class="d-flex align-items-center">
                                                    <div class="symbol symbol-35px me-4">
                                                <span class="symbol-label bg-light-primary">
                                                  <i class="{{ getNotificationIcon($notification->type) }}"></i>
                                                </span>
                                                    </div>
                                                    <div class="mb-0 me-2 text-hover-primary">
                                                        <span class="fs-6 text-gray-800 fw-bold text-hover-primary">{{ $notification->title }}</span>
                                                    </div>
                                                </div>
                                                <span class="badge badge-light fs-8">{{ \Carbon\Carbon::parse($notification->created_at)->diffForHumans(null, true)}}</span>
                                            </div>
                                        </div>
                                    </a>
                                @endforeach
                            @else
                                <div class="empty-state fs-6 text-gray-800 fw-bold text-center mt-5" data-height="400">
                                    <p>{{ __('messages.notification.you_don`t_have_any_new_notification') }}</p>
                                </div>
                        @endif
                    </div>
                    <div class="empty-state empty-notification d-none fs-6 text-gray-800 fw-bold text-center mt-5"
                         data-height="400">
                        <p>{{ __('messages.notification.you_don`t_have_any_new_notification') }}</p>
                    </div>
                </div>
            </div>
            <div class="d-flex align-items-stretch flex-shrink-0">
                <div class="d-flex align-items-stretch flex-shrink-0">
                    <div class="d-flex align-items-center ms-1 ms-lg-3" id="kt_header_user_menu_toggle">
                        <div class="cursor-pointer symbol symbol-30px symbol-md-40px" data-kt-menu-trigger="click"
                             data-kt-menu-attach="parent"
                             data-kt-menu-placement="bottom-{{ getLoggedInUser()->language == 'ar' ? 'start' : 'end' }}"
                             data-kt-menu-flip="bottom">
                            <img src="{{ Auth::user()->image_url ?? '' }}" alt="InfyOm" class="object-fit-cover">
                        </div>
                        <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg menu-state-primary fw-bold py-4 fs-6 w-275px"
                             data-kt-menu="true">
                            <div class="menu-item px-3">
                                <div class="menu-content d-flex align-items-center px-3 text-break">
                                    <div class="symbol symbol-50px me-5">
                                        <img alt="InfyOm" src="{{ Auth::user()->image_url??'' }}"
                                             class="object-fit-cover" id="loginUserImage">
                                    </div>
                                        <div class="d-flex flex-column">
                                            <div class="fw-bolder d-flex align-items-center fs-5">{{ (Auth::user()->full_name)??'' }}
                                            </div>
                                            <span
                                                    class="fw-bold text-muted fs-7">{{ (Auth::user()->email)??'' }}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="separator my-2"></div>
                                <div class="menu-item px-5">
                                    <a href="#" class="editProfile menu-link px-5" data-bs-toggle="modal"
                                       data-bs-target="#editProfileModal"
                                       data-id="{{ getLoggedInUserId() }}">{{ __('messages.user.edit_profile') }}</a>
                                </div>
                                @if(getLoggedInUser()->hasRole('Admin'))
                                    <div class="menu-item px-5">
                                        <a href="{{ route('subscription.pricing.plans.index') }}" class="menu-link px-5 subscription_plan">
                                            {{__('messages.subscription_plans.subscription_plans')}}
                                        </a>
                                    </div>
                                @endif
                                @if(session('impersonated_by'))
                                    <div class="menu-item px-5">
                                        <a href="{{ route('impersonate.userLogout') }}" class="menu-link px-5"><i class="fa fa-external-link"></i> {{ __('messages.user.back_to_admin') }}
                                        </a>
                                    </div>
                                @endif
                                <div class="menu-item px-5">
                                    <a href="#" data-bs-toggle="modal" data-id="{{ getLoggedInUserId() }}"
                                       data-bs-target="#changePasswordModal" class="menu-link px-5">
                                        <span class="menu-text">{{ __('messages.user.change_password') }}</span>
                                    </a>
                                </div>
                                <div class="menu-item px-5">
                                    <a href="#" data-bs-toggle="modal" data-id="{{ getLoggedInUserId() }}"
                                       data-bs-target="#changeLanguageModal" class="menu-link px-5">
                                        <span class="menu-text">{{__('messages.profile.change_language')}}</span>
                                    </a>
                                </div>
                                @if(!session('impersonated_by'))
                                    <div class="menu-item px-5">
                                        <a href="{{ route('logout.user') }}"
                                           onclick="event.preventDefault(); localStorage.clear();  document.getElementById('logout-form').submit();"
                                           class="menu-link px-5">
                                            <span class="menu-text">{{ __('messages.user.logout') }}</span>
                                        </a>
                                    </div>
                                    <form id="logout-form" action="{{ route('logout.user') }}" method="POST"
                                          class="d-none">
                                        {{ csrf_field() }}
                                    </form>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
