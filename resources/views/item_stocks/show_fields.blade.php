<div>
    <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" id="poverview" role="tabpanel">
            <div class="card mb-5 mb-xl-10">
                <div class="card-header border-0">
                    <div class="card-title m-0">
                        <h3 class="fw-bolder m-0">{{__('messages.item_stock.item_stock_details')}}</h3>
                    </div>
                </div>
                <div>
                    <div class="card-body  border-top p-9">
                        <div class="row mb-7">
                            <div class="col-lg-4 col-md-4 col-sm-2 d-flex flex-column">
                                {{ Form::label('item_category', __('messages.item_stock.item_category').(':'), ['class' => 'fw-bold text-muted py-3']) }}
                                <span class="fw-bolder fs-6 text-gray-800">{{ $itemStock->item->itemcategory->name }}</span>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-2 d-flex flex-column">
                                {{ Form::label('item', __('messages.item_stock.item').(':'), ['class' => 'fw-bold text-muted py-3']) }}
                                <span class="fw-bolder fs-6 text-gray-800">{{  $itemStock->item->name}}</span>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-2 d-flex flex-column">
                                {{ Form::label('supplier_name', __('messages.item_stock.supplier_name').(':'), ['class' => 'fw-bold text-muted py-3']) }}
                                <span class="fw-bolder fs-6 text-gray-800">{{ !empty($itemStock->supplier_name) ? $itemStock->supplier_name : __('messages.common.n/a')}}</span>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-2 d-flex flex-column">
                                {{ Form::label('store_name', __('messages.item_stock.store_name').(':'), ['class' => 'fw-bold text-muted py-3']) }}
                                <span class="fw-bolder fs-6 text-gray-800">{{ !empty($itemStock->store_name) ? $itemStock->store_name : __('messages.common.n/a')}}</span>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-2 d-flex flex-column">
                                {{ Form::label('quality', __('messages.item_stock.quantity').(':'), ['class' => 'fw-bold text-muted py-3']) }}
                                <p class="m-0">
                                    <span class="badge badge-light-success fs-6">{{ $itemStock->quantity}}</span></p>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-2 d-flex flex-column">
                                {{ Form::label('purchase_price', __('messages.item_stock.purchase_price').(':'), ['class' => 'fw-bold text-muted py-3']) }}
                                <span class="fw-bolder fs-6 text-gray-800">{{number_format($itemStock->purchase_price, 2)}}</span>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-2 d-flex flex-column">
                                {{ Form::label('attachment', __('messages.item_stock.attachment').(':'), ['class' => 'fw-bold text-muted py-3']) }}
                                <span class="fw-bolder fs-6 text-gray-800">
                                    @if(!empty($itemStock->item_stock_url))
                                        <a href="{{ $itemStock->item_stock_url }}" target="_blank">{{ __('messages.common.view')}}</a>
                                    @else
                                        {{__('messages.common.n/a')}}
                                    @endif
                                </span>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-2 d-flex flex-column">
                                {{ Form::label('created_at', __('messages.common.created_on').(':'), ['class' => 'fw-bold text-muted py-3']) }}
                                <span class="fw-bolder fs-6 text-gray-800" title="{{ date('jS M, Y', strtotime($itemStock->created_at)) }}">{{ $itemStock->created_at->diffForHumans() }}</span>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-2 d-flex flex-column">
                                {{ Form::label('updated_at', __('messages.common.updated_at').(':'), ['class' => 'fw-bold text-muted py-3']) }}
                                <span class="fw-bolder fs-6 text-gray-800" title="{{ date('jS M, Y', strtotime($itemStock->updated_at)) }}">{{ $itemStock->updated_at->diffForHumans() }}</span>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-2 d-flex flex-column">
                                {{ Form::label('description', __('messages.item.description').(':'), ['class' => 'fw-bold text-muted py-3']) }}
                                <span class="fw-bolder fs-6 text-gray-800">{!! !empty($itemStock->description) ? nl2br(e($itemStock->description)) : __('messages.common.n/a')  !!}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
