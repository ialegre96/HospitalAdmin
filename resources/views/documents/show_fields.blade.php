<div>
    <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" id="poverview" role="tabpanel">
            <div class="card mb-5 mb-xl-10">
                <div class="card-header border-0">
                    <div class="card-title m-0">
                        <h3 class="fw-bolder m-0">{{__('messages.document.document_detail')}}</h3>
                    </div>
                </div>
                <div>
                    <div class="card-body  border-top p-9">
                        <div class="row mb-7">
                            <div class="col-lg-3 d-flex flex-column">
                                <label class="fw-bold text-muted py-3">{{ __('messages.document.documents').(':')  }}</label>
                                <span class="fw-bolder fs-6 text-gray-800">{{$documents->title }}</span>
                            </div>
                            <div class="col-lg-3 d-flex flex-column">
                                <label class="fw-bold text-muted py-3">{{ __('messages.document.document_type').(':')  }}</label>
                                <span class="fw-bolder fs-6 text-gray-800">{{$documents->documentType->name}}</span>
                            </div>
                            <div class="col-lg-3 d-flex flex-column">
                                <label class="fw-bold text-muted py-3">{{ __('messages.document.patient').(':')  }}</label>
                                <span class="fw-bolder fs-6 text-gray-800">{{$documents->patient->user->full_name}}</span>
                            </div>
                            <div class="col-lg-3 d-flex flex-column">
                                <label class="fw-bold text-muted py-3">{{ __('messages.document.attachment').(':')  }}</label>
                                <p class="m-0">@if(!empty($documents->document_url))
                                        <a href="{{$documents->document_url}}" target="_blank"><span class="badge fs-6 badge-light-info">{{__('messages.document.view')}}</span></a>
                                    @else
                                        <span class="fw-bolder fs-6 text-gray-800">{{__('messages.common.n/a').(':')}}</span>
                                    @endif</p>
                            </div>
                            <div class="col-lg-3 d-flex flex-column">
                                <label class="fw-bold text-muted py-3">{{ __('messages.document.notes').(':')  }}</label>
                                <span class="fw-bolder fs-6 text-gray-800">{!! !empty($documents->notes)? nl2br(e($documents->notes)):'N/A' !!}</span>
                            </div>
                            <div class="col-lg-3 d-flex flex-column">
                                <label class="fw-bold text-muted py-3">{{ __('messages.common.created_on').(':')  }}</label>
                                <span class="fw-bolder fs-6 text-gray-800" data-toggle="tooltip" data-placement="right" title="{{ date('jS M, Y', strtotime($documents->created_at)) }}">{{ $documents->created_at->diffForHumans() }}</span>
                            </div>
                            <div class="col-lg-3 d-flex flex-column">
                                <label class="fw-bold text-muted py-3">{{ __('messages.common.last_updated').(':')  }}</label>
                                <span class="fw-bolder fs-6 text-gray-800" data-toggle="tooltip" data-placement="right" title="{{ date('jS M, Y', strtotime($documents->updated_at)) }}">{{ $documents->updated_at->diffForHumans() }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
