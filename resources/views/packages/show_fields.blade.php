<div>
    <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" id="poverview" role="tabpanel">
            <div class="card mb-5 mb-xl-10">
                <div class="card-header border-0">
                    <div class="card-title m-0">
                        <h3 class="fw-bolder m-0">{{__('messages.package.package_details')}}</h3>
                    </div>
                    <div class="d-flex align-items-center py-1">
                        @if (!Auth::user()->hasRole('Doctor|Case Manager|Patient'))
                            <a class="btn btn-sm btn-primary me-2"
                               href="{{ route('packages.edit',['package' => $package->id])}}">{{ __('messages.common.edit') }}</a>
                        @endif
                        <a href="{{ url()->previous() }}"
                           class="btn btn-sm btn-light btn-active-light-primary pull-right">{{ __('messages.common.back') }}</a>
                    </div>
                </div>
                <div>
                    <div class="card-body  border-top p-9">
                        <div class="row mb-7">
                            <div class="col-lg-3 d-flex flex-column">
                                <label
                                    class="fw-bold text-muted py-3">{{ __('messages.package.package').(':')  }}</label>
                                <span class="fw-bolder fs-6 text-gray-800">{{ $package->name }}</span>
                            </div>
                            <div class="col-lg-3 d-flex flex-column">
                                <label
                                    class="fw-bold text-muted py-3">{{ __('messages.package.discount').(':')  }}</label>
                                <span class="fw-bolder fs-6 text-gray-800">{{$package->discount }}%</span>
                            </div>
                            <div class="col-lg-3 d-flex flex-column">
                                <label class="fw-bold text-muted py-3">{{ __('messages.common.created_on').(':')  }}</label>
                                <span class="fw-bolder fs-6 text-gray-800" data-toggle="tooltip" data-placement="right" title="{{ date('jS M, Y', strtotime($package->created_at)) }}">{{ $package->created_at->diffForHumans() }}</span>
                            </div>
                            <div class="col-lg-3 d-flex flex-column">
                                <label class="fw-bold text-muted py-3">{{ __('messages.common.last_updated').(':')  }}</label>
                                <span class="fw-bolder fs-6 text-gray-800" data-toggle="tooltip" data-placement="right" title="{{ date('jS M, Y', strtotime($package->updated_at)) }}">{{ $package->updated_at->diffForHumans() }}</span>
                            </div>
                            <div class="col-lg-3 d-flex flex-column">
                                <label class="fw-bold text-muted py-3">{{ __('messages.common.description').(':')  }}</label>
                                <span class="fw-bolder fs-6 text-gray-800">{!! !empty($package->description)? nl2br(e($package->description)):'N/A'  !!}</span>
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
                <h3 class="fw-bolder m-0">{{ __('messages.services') }}</h3>
            </div>
        </div>
        <div class="card-body border-top p-9">
            <div class="row">
                <div class="col-lg-12">
                    <div class="table-responsive viewList">
                        <table id="accountPayments" class="display table table-responsive-sm table-striped align-middle table-row-dashed fs-6 gy-5 dataTable no-footer w-100">
                            <thead>
                            <tr class="text-start text-muted fw-bolder fs-7 text-uppercase gs-0">
                                <th class="text-center">#</th>
                                <th>{{ __('messages.package.service') }}</th>
                                <th class="text-right">{{ __('messages.package.qty') }}</th>
                                <th class="text-right">{{ __('messages.package.rate') }}</th>
                                <th class="text-right">{{ __('messages.package.amount') }}</th>
                            </tr>
                            </thead>
                            <tbody class="fw-bold">
                            @forelse($package->packageServicesItems as $index => $packageServiceItem)
                                        <tr>
                                            <td class="text-center w-5">{{ $index + 1 }}</td>
                                            <td>
                                                {{ $packageServiceItem->service->name }}
                                            </td>
                                            <td class="table__qty text-right">
                                                {{ $packageServiceItem->quantity }}
                                            </td>
                                            <td class="text-right">
                                                <b>{{ getCurrencySymbol() }}</b> {{ number_format($packageServiceItem->rate) }}
                                            </td>
                                            <td class="text-right"><b>{{ getCurrencySymbol() }}</b> {{ number_format($packageServiceItem->amount) }}
                                            </td>
                                        </tr>
                            @empty
                                <tr>
                                    <td class="text-center" colspan="5">{{__('messages.common.no_data_available')}}</td>
                                </tr>
                                    @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
