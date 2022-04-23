<div>
    <div class="card mb-5 mb-xl-10">
        <div class="card-body pt-9 pb-0">
            <div class="d-flex flex-wrap flex-sm-nowrap mb-3">
                <div class="me-7 mb-4">
                    <div class="symbol symbol-100px symbol-lg-160px symbol-fixed position-relative">
                        <img src="{{$userData->image_url}}" alt="image" class="object-fit-cover"/>
                    </div>
                </div>
                <div class="flex-grow-1">
                    <div class="d-flex justify-content-between align-items-start flex-wrap mb-2">
                        <div class="d-flex flex-column">
                            <div class="d-flex align-items-center mb-2">
                                <a href="#"
                                   class="text-gray-800 text-hover-primary fs-2 fw-bolder me-4">{{$userData->full_name}}</a>
                                <span
                                    class="badge badge-light-{{ $userData->status === 1 ? 'success' : 'danger' }} fw-bolder ms-2 fs-8 py-1 px-3">{{ ($userData->status === 1) ? __('messages.common.active') : __('messages.common.de_active') }}</span>
                            </div>
                            <div class="d-flex flex-wrap fw-bold fs-6 mb-4 pe-2">

                                <a href="mailto:{{$userData->email}}"
                                   class="d-flex align-items-center text-gray-400 text-hover-primary mb-2 me-2">
                                    <span class="svg-icon svg-icon-4 me-1">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                             viewBox="0 0 24 24" fill="none">
                                            <path opacity="0.3"
                                                  d="M21 19H3C2.4 19 2 18.6 2 18V6C2 5.4 2.4 5 3 5H21C21.6 5 22 5.4 22 6V18C22 18.6 21.6 19 21 19Z"
                                                  fill="black"></path>
                                            <path
                                                d="M21 5H2.99999C2.69999 5 2.49999 5.10005 2.29999 5.30005L11.2 13.3C11.7 13.7 12.4 13.7 12.8 13.3L21.7 5.30005C21.5 5.10005 21.3 5 21 5Z"
                                                fill="black"></path>
                                        </svg>
                                    </span>
                                    {{$userData->email}}
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="d-flex overflow-auto h-55px">
                <ul class="nav nav-stretch nav-line-tabs nav-line-tabs-2x border-transparent fs-5 fw-bolder flex-nowrap">
                    <li class="nav-item">
                        <a class="nav-link text-active-primary me-6 active" data-bs-toggle="tab" href="#poverview">Overview</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" id="poverview" role="tabpanel">
            <div class="card mb-5 mb-xl-10">
                <div class="card-header border-0">
                    <div class="card-title m-0">
                        <h3 class="fw-bolder m-0">Overview</h3>
                    </div>
                </div>
                <div>
                    <div class="card-body  border-top p-9">
                        <div class="row mb-7">
                            <label class="col-lg-4 fw-bold text-muted">{{ __('messages.user.first_name')  }}</label>
                            <div class="col-lg-8">
                                <span class="fw-bolder fs-6 text-gray-800">{{$userData->first_name}}</span>
                            </div>
                        </div>
                        <div class="row mb-7">
                            <label class="col-lg-4 fw-bold text-muted">{{ __('messages.user.last_name')  }}</label>
                            <div class="col-lg-8">
                                <span class="fw-bolder fs-6 text-gray-800">{{$userData->last_name}}</span>
                            </div>
                        </div>
                        <div class="row mb-7">
                            <label class="col-lg-4 fw-bold text-muted">{{ __('messages.sms.role')  }}</label>
                            <div class="col-lg-8">
                                <span class="fw-bolder fs-6 text-gray-800">{{ $userData->roles->first()->name}}</span>
                            </div>
                        </div>
                        <div class="row mb-7">
                            <label class="col-lg-4 fw-bold text-muted">{{ __('messages.visitor.phone')  }}</label>
                            <div class="col-lg-8">
                                <span class="fw-bolder fs-6 text-gray-800">{{ ($userData->phone=='')?  __('messages.common.n/a') : $userData->phone}}</span>
                            </div>
                        </div>
                        <div class="row mb-7">
                            <label class="col-lg-4 fw-bold text-muted">{{ __('messages.user.gender')  }}</label>
                            <div class="col-lg-8">
                                <span class="fw-bolder fs-6 text-gray-800">{{ ($userData->gender == '0')? __('messages.user.male') : __('messages.user.female')}}</span>
                            </div>
                        </div>
                        <div class="row mb-7">
                            <label class="col-lg-4 fw-bold text-muted">{{ __('messages.user.dob') }}</label>
                            <div class="col-lg-8">
                                <span class="fw-bolder fs-6 text-gray-800 me-2">{{ ($userData->dob == '')? __('messages.common.n/a') : \Carbon\Carbon::parse($userData->dob)->format('jS M, Y') }}</span>
                            </div>
                        </div>
                        <div class="row mb-7">
                            <label class="col-lg-4 fw-bold text-muted">{{ __('messages.common.status') }}</label>
                            <div class="col-lg-8">
                                <span class="fw-bolder fs-6 text-gray-800 me-2">
                                    @if($userData->status=='1')
                                        <span class="badge badge-light-success"> {{__('messages.common.active')}} </span>
                                    @else
                                        <span class="badge badge-light-danger">{{ __('messages.common.de_active') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="row mb-7">
                            <label class="col-lg-4 fw-bold text-muted">{{ __('messages.common.created_at') }}</label>
                            <div class="col-lg-8">
                                <span class="fw-bolder fs-6 text-gray-800 me-2">{{ $userData->created_at->diffForHumans() }}</span>
                            </div>
                        </div>
                        <div class="row mb-7">
                            <label class="col-lg-4 fw-bold text-muted">{{ __('messages.common.updated_at') }}</label>
                            <div class="col-lg-8">
                                <span class="fw-bolder fs-6 text-gray-800 me-2">{{ $userData->updated_at->diffForHumans() }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
