<div>
    <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" id="poverview" role="tabpanel">
            <div class="card mb-5 mb-xl-10">
                <div class="card-header border-0">
                    <div class="card-title m-0">
                        <h3 class="fw-bolder m-0">{{__('messages.issued_item.issued_item_details')}}</h3>
                    </div>
                </div>
                <div>
                    <div class="card-body  border-top p-9">
                        <div class="row mb-7">
                            <div class="col-lg-4 col-md-4 col-sm-2 d-flex flex-column">
                                {{ Form::label('department_id', __('messages.issued_item.department_id').(':'), ['class' => 'fw-bold text-muted py-3']) }}
                                <span class="fw-bolder fs-6 text-gray-800">{{$issuedItem->department->name}}</span>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-2 d-flex flex-column">
                                {{ Form::label('user_id', __('messages.issued_item.user_id').(':'), ['class' => 'fw-bold text-muted py-3']) }}
                                <span class="fw-bolder fs-6 text-gray-800">{{$issuedItem->user->full_name}}</span>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-2 d-flex flex-column">
                                {{ Form::label('issued_by', __('messages.issued_item.issued_by').(':'), ['class' => 'fw-bold text-muted py-3']) }}
                                <span class="fw-bolder fs-6 text-gray-800">{{ $issuedItem->issued_by}}</span>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-2 d-flex flex-column">
                                {{ Form::label('issued_date', __('messages.issued_item.issued_date').(':'), ['class' => 'fw-bold text-muted py-3']) }}
                                <span class="fw-bolder fs-6 text-gray-800" data-toggle="tooltip" data-placement="right" title="{{ $issuedItem->issued_date->diffForHumans() }}">{{ date('jS M, Y', strtotime($issuedItem->issued_date)) }}</span>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-2 d-flex flex-column">
                                {{ Form::label('return_date', __('messages.issued_item.return_date').(':'), ['class' => 'fw-bold text-muted py-3']) }}
                                @if(!empty($issuedItem->return_date))
                                    <span class="fw-bolder fs-6 text-gray-800" data-toggle="tooltip" data-placement="right" title="{{ $issuedItem->return_date->diffForHumans() }}">{{ date('jS M, Y', strtotime($issuedItem->return_date)) }}</span>
                                @else
                                    <span class="fw-bolder fs-6 text-gray-800">{{ __('messages.common.n/a') }}</span>
                                @endif
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-2 d-flex flex-column">
                                {{ Form::label('item_category', __('messages.issued_item.item_category').(':'), ['class' => 'fw-bold text-muted py-3']) }}
                                <span class="fw-bolder fs-6 text-gray-800">{{$issuedItem->item->itemcategory->name}}</span>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-2 d-flex flex-column">
                                {{ Form::label('item', __('messages.issued_item.item').(':'), ['class' => 'fw-bold text-muted py-3']) }}
                                <span class="fw-bolder fs-6 text-gray-800">{{ $issuedItem->item->name}}</span>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-2 d-flex flex-column">
                                {{ Form::label('quantity', __('messages.issued_item.quantity').(':'), ['class' => 'fw-bold text-muted py-3']) }}
                                <p class="m-0">
                                    <span class="badge fs-6 badge-light-primary">{{ $issuedItem->quantity}}</span></p>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-2 d-flex flex-column">
                                {{ Form::label('status', __('messages.common.status').(':'), ['class' => 'fw-bold text-muted py-3']) }}
                                <p class="m-0">
                                    <span class="badge fs-6 badge-light-{{($issuedItem->status == 0) ? 'info' : 'primary'}}">{{ ($issuedItem->status) ? __('messages.issued_item.item_returned') : __('messages.issued_item.item_return') }}</span>
                                </p>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-2 d-flex flex-column">
                                {{ Form::label('created_at', __('messages.common.created_on').(':'), ['class' => 'fw-bold text-muted py-3']) }}
                                <span class="fw-bolder fs-6 text-gray-800" title="{{ date('jS M, Y', strtotime($issuedItem->created_at)) }}">{{ $issuedItem->created_at->diffForHumans() }}</span>
                            </div>
                            <div class="col-lg-8 d-flex flex-column">
                                {{ Form::label('description', __('messages.issued_item.description').(':'), ['class' => 'fw-bold text-muted py-3']) }}
                                <span class="fw-bolder fs-6 text-gray-800">{!! !empty($issuedItem->description) ? nl2br(e($issuedItem->description)) : __('messages.common.n/a') !!}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
