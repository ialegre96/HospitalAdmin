<div>
    <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" id="poverview" role="tabpanel">
            <div class="card mb-5 mb-xl-10">
                <div class="card-header border-0">
                    <div class="card-title m-0">
                        <h3 class="fw-bolder m-0">{{ __('messages.bed_type.bed_type_details')}}</h3>
                    </div>
                    <div class="d-flex align-items-center py-1">
                        <a class="btn btn btn-sm btn-primary me-2 edit-btn"
                           data-id="{{ $bedType->id }}">{{ __('messages.common.edit') }}</a>
                        <a href="{{ url()->previous() }}"
                           class="btn btn-sm btn-light btn-active-light-primary pull-right">{{ __('messages.common.back') }}</a>
                    </div>
                </div>
                <div>
                    <div class="card-body  border-top p-9">
                        <div class="row mb-7">
                            <div class="col-lg-6 col-md-6 col-sm-2 d-flex flex-column">
                                {{ Form::label('title', __('messages.bed.bed_type').(':'), ['class' => 'fw-bold text-muted py-3']) }}
                                <span class="fw-bolder fs-6 text-gray-800">{{$bedType->title}}</span>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-2 d-flex flex-column">
                                {{ Form::label('description', __('messages.bed_type.description').(':'), ['class' => 'fw-bold text-muted py-3']) }}
                                <span class="fw-bolder fs-6 text-gray-800">{!! !empty($bedType->description)?nl2br(e($bedType->description)):'N/A' !!}</span>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-2 d-flex flex-column">
                                {{ Form::label('created on', __('messages.common.created_on').(':'), ['class' => 'fw-bold text-muted py-3']) }}
                                <span class="fw-bolder fs-6 text-gray-800" title="{{ date('jS M, Y', strtotime($bedType->created_at)) }}">{{ $bedType->created_at->diffForHumans() }}</span>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-2 d-flex flex-column">
                                {{ Form::label('updated on', __('messages.common.updated_at').(':'), ['class' => 'fw-bold text-muted py-3']) }}
                                <span class="fw-bolder fs-6 text-gray-800" title="{{ date('jS M, Y', strtotime($bedType->updated_at)) }}">{{ $bedType->updated_at->diffForHumans() }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card mb-5 mb-xl-10">
        <div class="card-header border-0">
            <div class="card-title m-0">
                <h3 class="fw-bolder m-0">{{ __('messages.bed.beds') }}</h3>
            </div>
        </div>
        <div class="card-body border-top p-9">
            <?php
            $style = 'style=';
            $maxWidth = 'max-width:';
            ?>
            <div class="row">
                <div class="col-lg-12">
                    <div class="table-responsive viewList">
                        @include('layouts.search-component')
                        <table id="bedTypesTable"
                               class="display table table-responsive-sm table-striped align-middle table-row-dashed fs-6 gy-5 gx-5 dataTable no-footer w-100">
                            <thead>
                            <tr class="text-start text-muted fw-bolder fs-7 text-uppercase gs-0">
                                <th>{{ __('messages.bed_assign.bed') }}</th>
                                <th>{{ __('messages.bed.description') }}</th>
                                <th>{{ __('messages.bed.charge') }}</th>
                                <th class="text-center">{{ __('messages.bed.available') }}</th>
                            </tr>
                            </thead>
                            <tbody class="fw-bold">
                            @foreach($beds as $bed)
                                <tr>
                                    <td><a href="{{ url('beds',$bed->id) }}">{{ $bed->name }}</a></td>
                                    <td class="text-truncate"
                                    {{$style}}="{{$maxWidth}} 150px"
                                    >{!! !empty($bed->description)?nl2br(e($bed->description)):'N/A' !!}</td>
                                    <td class="text-right">
                                        <b>{{ getCurrencySymbol() }}</b> {{ number_format($bed->charge, 2) }}
                                    </td>
                                    <td class="text-center">
                                        <span class="badge badge-light-{{($bed->is_available) ? 'success':'danger'}}">
                                        {{ ($bed->is_available) ? __('messages.common.yes') : __('messages.common.no') }}</span>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
