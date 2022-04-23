<div>
    <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" id="poverview" role="tabpanel">
            <div class="card mb-5 mb-xl-10">
                <div class="card-header border-0">
                    <div class="card-title m-0">
                        <h3 class="fw-bolder m-0">{{__('messages.notice_board.details')}}</h3>
                    </div>
                    <div class="d-flex align-items-center py-1">
                        <a href="{{ url()->previous() }}"
                           class="btn btn-sm btn-light btn-active-light-primary pull-right">{{ __('messages.common.back') }}</a>
                    </div>
                </div>
                <div>
                    <div class="card-body  border-top p-9">
                        <div class="row mb-7">
                            <div class="col-lg-8 col-md-4 col-sm-2 d-flex flex-column">
                                {{ Form::label('title', __('messages.notice_board.title').':', ['class' => 'fw-bold text-muted py-3']) }}
                                <span class="fw-bolder fs-6 text-gray-800">{{ $noticeBoard->title }}</span>
                            </div>
                            <div class="col-lg-2 col-md-4 col-sm-2 d-flex flex-column">
                                {{ Form::label('created_at', __('messages.common.created_on').':', ['class' => 'fw-bold text-muted py-3']) }}
                                <span data-toggle="tooltip" data-placement="right"
                                      title="{{ date('jS M, Y', strtotime($noticeBoard->created_at)) }}"
                                      class="fw-bolder fs-6 text-gray-800">{{ $noticeBoard->created_at->diffForHumans() }}</span>
                            </div>
                            <div class="col-lg-2 col-md-4 col-sm-2 d-flex flex-column">
                                {{ Form::label('updated_at', __('messages.common.last_updated').':', ['class' => 'fw-bold text-muted py-3']) }}
                                <span data-toggle="tooltip" data-placement="right"
                                      title="{{ date('jS M, Y', strtotime($noticeBoard->updated_at)) }}"
                                      class="fw-bolder fs-6 text-gray-800">{{ $noticeBoard->updated_at->diffForHumans() }}</span>
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12 d-flex flex-column">
                                {{ Form::label('description', __('messages.notice_board.description').':', ['class' => 'fw-bold text-muted py-3']) }}
                                <span
                                    class="fw-bolder fs-6 text-gray-800">{!! !empty($noticeBoard->description)? nl2br(e($noticeBoard->description)):'N/A' !!}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
