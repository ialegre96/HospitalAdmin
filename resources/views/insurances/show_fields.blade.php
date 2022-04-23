<div>
    <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" id="poverview" role="tabpanel">
            <div class="card mb-5 mb-xl-10">
                <div class="card-header border-0">
                    <div class="card-title m-0">
                        <h3 class="fw-bolder m-0"> {{ __('messages.insurance.insurance_details') }}</h3>
                    </div>
                    <div class="d-flex align-items-center py-1">
                        @if (!Auth::user()->hasRole('Doctor|Case Manager|Patient'))
                            <a class="btn btn-sm btn-primary me-2"
                               href="{{route('insurances.edit',['insurance' => $insurance->id])}}">{{ __('messages.common.edit') }}</a>
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
                                    class="fw-bold text-muted py-3">{{ __('messages.insurance.insurance').(':') }}</label>
                                <span class="fw-bolder fs-6 text-gray-800">{{ $insurance->name}}</span>
                            </div>
                            <div class="col-lg-3 d-flex flex-column">
                                <label
                                    class="fw-bold text-muted py-3">{{ __('messages.insurance.service_tax').(':')  }}</label>
                                <span class="fw-bolder fs-6 text-gray-800"><b>{{ getCurrencySymbol() }}</b> {{ number_format($insurance->service_tax, 2)  }}</span>
                            </div>
                            <div class="col-lg-3 d-flex flex-column">
                                <label class="fw-bold text-muted py-3">{{ __('messages.insurance.discount').(':')  }}</label>
                                <span class="fw-bolder fs-6 text-gray-800">{{ isset($insurance->discount) ? $insurance->discount.'%':'N/A'}}</span>
                            </div>
                            <div class="col-lg-3 d-flex flex-column">
                                <label class="fw-bold text-muted py-3">{{ __('messages.insurance.insurance_no').(':')  }}</label>
                                <span class="fw-bolder fs-6 text-gray-800">{{ $insurance->insurance_no}}</span>
                            </div>
                            <div class="col-lg-3 d-flex flex-column">
                                <label class="fw-bold text-muted py-3">{{ __('messages.insurance.insurance_code').(':')  }}</label>
                                <span class="fw-bolder fs-6 text-gray-800">{{$insurance->insurance_code }}</span>
                            </div>
                            <div class="col-lg-3 d-flex flex-column">
                                <label class="fw-bold text-muted py-3">{{ __('messages.insurance.hospital_rate').(':')  }}</label>
                                <span class="fw-bolder fs-6 text-gray-800">{{ number_format($insurance->hospital_rate, 2) }}</span>
                            </div>
                            <div class="col-lg-3 d-flex flex-column">
                                <label class="fw-bold text-muted py-3">{{ __('messages.common.total').(':')  }}</label>
                                <span class="fw-bolder fs-6 text-gray-800"><b>{{ getCurrencySymbol() }}</b> {{ number_format($insurance->total, 2) }}</span>
                            </div>
                            <div class="col-lg-3 d-flex flex-column">
                                <label class="fw-bold text-muted py-3">{{ __('messages.common.status').(':')  }}</label>
                                <p class="m-0">
                                    <span
                                        class="badge fs-6 badge-light-{{!empty($insurance->status === 1) ? 'success' : 'danger'}}">{{($insurance->status === 1) ? __('messages.common.active') : __('messages.common.de_active')}}</span>
                                </p>
                            </div>
                            <div class="col-lg-3 d-flex flex-column">
                                <label
                                    class="fw-bold text-muted py-3">{{ __('messages.insurance.remark').(':')  }}</label>
                                <span
                                    class="fw-bolder fs-6 text-gray-800">{!! !empty($insurance->remark) ? nl2br(e($insurance->remark)):'N/A'  !!}</span>
                            </div>
                            <div class="col-lg-3 d-flex flex-column">
                                <label
                                    class="fw-bold text-muted py-3">{{ __('messages.common.created_at').(':')  }}</label>
                                <span
                                    class="fw-bolder fs-6 text-gray-800">{{ $insurance->created_at->diffForHumans() }}</span>
                            </div>
                            <div class="col-lg-3 d-flex flex-column">
                                <label
                                    class="fw-bold text-muted py-3">{{ __('messages.common.last_updated').(':')  }}</label>
                                <span
                                    class="fw-bolder fs-6 text-gray-800">{{ $insurance->updated_at->diffForHumans() }}</span>
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
                <h3 class="fw-bolder m-0">{{ __('messages.insurance.disease_details') }}</h3>
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
                                <th class="w-75">{{ __('messages.insurance.diseases_name') }}</th>
                                <th class="w-25 text-right">{{ __('messages.insurance.diseases_charge') }}</th>
                            </tr>
                            </thead>
                            <tbody class="fw-bold">
                            @forelse($diseases as $index => $disease)
                                <tr>
                                    <td class="text-center w-5">{{ $loop->iteration }}</td>
                                    <td>
                                        {{ $disease->disease_name }}
                                    </td>
                                    <td class="table__qty text-right">
                                        <b>{{ getCurrencySymbol() }}</b> {{ number_format($disease->disease_charge, 2) }}
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td class="text-center" colspan="3">{{__('messages.common.no_data_available')}}</td>
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
