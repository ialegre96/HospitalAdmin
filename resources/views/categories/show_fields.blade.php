<div>
    <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" id="poverview" role="tabpanel">
            <div class="card mb-5 mb-xl-10">
                <div class="card-header border-0">
                    <div class="card-title m-0">
                        <h3 class="fw-bolder m-0">{{__('messages.medicine.medicine_category')}}</h3>
                    </div>
                    <div class="d-flex align-items-center py-1">
                        <a data-id="{{ $category->id }}"
                           class="btn btn-sm btn-primary me-2 edit-btn">{{ __('messages.common.edit') }}</a>
                        <a href="{{ route('categories.index') }}"
                           class="btn btn-sm btn-light btn-active-light-primary pull-right">{{ __('messages.common.back') }}</a>
                    </div>
                </div>
                <div>
                    <div class="card-body  border-top p-9">
                        <div class="row mb-7">
                            <div class="col-lg-4 d-flex flex-column">
                                <label class="fw-bold text-muted py-3">{{ __('messages.medicine.category')  }}</label>
                                <span class="fw-bolder fs-6 text-gray-800">{{ $category->name}}</span>
                            </div>
                            <div class="col-lg-4 d-flex flex-column">
                                <label class="fw-bold text-muted py-3">{{ __('messages.common.status')  }}</label>
                                <p class="m-0">
                                    <span class="badge fs-6 badge-light-{{!empty($category->is_active == 1) ? 'success' : 'danger'}}">{{ ($category->is_active == 1) ? __('messages.common.active') : __('messages.common.de_active') }}</span>
                                </p>
                            </div>
                            <div class="col-lg-4 d-flex flex-column">
                                <label class="fw-bold text-muted py-3">{{ __('messages.common.created_on')  }}</label>
                                <span class="fw-bolder fs-6 text-gray-800" data-toggle="tooltip" data-placement="right" title="{{ \Carbon\Carbon::parse($category->created_at)->format('jS M, Y') }}">{{ \Carbon\Carbon::parse($category->created_at)->diffForHumans() }}</span>
                            </div>
                            <div class="col-lg-4 d-flex flex-column">
                                <label class="fw-bold text-muted py-3">{{ __('messages.common.last_updated')  }}</label>
                                <span class="fw-bolder fs-6 text-gray-800" data-toggle="tooltip" data-placement="right" title="{{ \Carbon\Carbon::parse($category->updated_at)->format('jS M, Y') }}">{{ \Carbon\Carbon::parse($category->updated_at)->diffForHumans() }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card mb-5 mb-xl-10">
                <div class="card-header border-0">
                    <div class="card-title m-0">
                        <h3 class="fw-bolder m-0">{{ __('messages.medicine.medicines') }}</h3>
                    </div>
                </div>
                <div class="card-body border-top p-9">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="table-responsive viewList">
                                @include('layouts.search-component')
                                <table id="categoryTable" class="display table table-responsive-sm table-striped align-middle table-row-dashed fs-6 gy-5 gx-5 dataTable no-footer w-100">
                                    <thead>
                                    <tr class="text-start text-muted fw-bolder fs-7 text-uppercase gs-0">
                                        <th class="w-10">{{ __('messages.medicine.medicine') }}</th>
                                        <th class="w-15">{{ __('messages.medicine.brand') }}</th>
                                        <th class="w-50">{{ __('messages.medicine.description') }}</th>
                                        <th class="w-10 text-right">{{ __('messages.medicine.selling_price') }}</th>
                                        <th class="w-10 text-right">{{ __('messages.medicine.buying_price') }}</th>
                                    </tr>
                                    </thead>
                                    <tbody class="fw-bold">
                                    @foreach($medicines as $medicine)
                                        <tr>
                                            <td>{{ $medicine->name }}</td>
                                            <td>{{ $medicine->brand->name }}</td>
                                            <td>{!! !empty($medicine->description)?nl2br(e($medicine->description)):'N/A' !!}</td>
                                            <td class="text-right">
                                                <b>{{ getCurrencySymbol() }}</b> {{ number_format ($medicine->selling_price, 2) }}
                                            </td>
                                            <td class="text-right">
                                                <b>{{ getCurrencySymbol() }}</b> {{ number_format ($medicine->buying_price, 2) }}
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
    </div>
</div>
