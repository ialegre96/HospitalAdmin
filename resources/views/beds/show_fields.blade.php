<div>
    <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" id="poverview" role="tabpanel">
            <div class="card mb-5 mb-xl-10">
                <div class="card-header border-0">
                    <div class="card-title m-0">
                        <h3 class="fw-bolder m-0">{{__('messages.bed.bed_details')}}</h3>
                    </div>
                    <div class="d-flex align-items-center py-1">
                        @if (!Auth::user()->hasRole('Doctor|Receptionist'))
                            <a class="btn btn-sm btn-primary edit-btn me-2"
                               data-id="{{ $bed->id }}">{{ __('messages.common.edit') }}</a>
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
                                    class="fw-bold text-muted py-3">{{ __('messages.bed_assign.bed').(':')  }}</label>
                                <span class="fw-bolder fs-6 text-gray-800">{{$bed->name}}</span>
                            </div>
                            <div class="col-lg-3 d-flex flex-column">
                                <label class="fw-bold text-muted py-3">{{ __('messages.bed.bed_type').(':')  }}</label>
                                <span class="fw-bolder fs-6 text-gray-800">{{$bed->bedType->title }}</span>
                            </div>
                            <div class="col-lg-3 d-flex flex-column">
                                <label class="fw-bold text-muted py-3">{{ __('messages.bed.bed_id').(':')  }}</label>
                                <span class="fw-bolder fs-6 text-gray-800">{{$bed->bed_id  }}</span>
                            </div>
                            <div class="col-lg-3 d-flex flex-column">
                                <label class="fw-bold text-muted py-3">{{ __('messages.bed.charge').(':')  }}</label>
                                <span class="fw-bolder fs-6 text-gray-800">{{ getCurrencySymbol() }} {{ number_format($bed->charge,2) }}</span>
                            </div>
                            <div class="col-lg-3 d-flex flex-column">
                                <label class="fw-bold text-muted py-3">{{ __('messages.bed.available').(':')  }}</label>
                                <p class="m-0">
                                    <span class="badge fs-6 badge-light-{{!empty($bed->is_available) ? 'success' : 'danger' }} mt-2">{{ ($bed->is_available) ? 'Yes' : 'No'}}</span>
                                </p>
                            </div>
                            <div class="col-lg-3 d-flex flex-column mb-2">
                                <label class="fw-bold text-muted py-3">{{ __('messages.common.created_at').(':')  }}</label>
                                <span class="fw-bolder fs-6 text-gray-800" data-toggle="tooltip" data-placement="right"
                                      title="{{ date('jS M, Y', strtotime($bed->created_at)) }}">{{ $bed->created_at->diffForHumans() }}</span>
                            </div>
                            <div class="col-lg-3 d-flex flex-column mb-2">
                                <label class="fw-bold text-muted py-3">{{ __('messages.common.updated_at').(':')  }}</label>
                                <span class="fw-bolder fs-6 text-gray-800" data-toggle="tooltip" data-placement="right"
                                      title="{{ date('jS M, Y', strtotime($bed->updated_at)) }}">{{ $bed->updated_at->diffForHumans() }}</span>
                            </div>
                            <div class="col-lg-12 d-flex flex-column mb-2">
                                <label class="fw-bold text-muted py-3">{{ __('messages.bed.description').(':')  }}</label>
                                <span class="fw-bolder fs-6 text-gray-800">{!! !empty($bed->description) ? nl2br(e($bed->description)) : 'N/A'!!}</span>
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
                <h3 class="fw-bolder m-0">{{ __('messages.bed_assign.bed_assigns') }}</h3>
            </div>
        </div>
        <div class="card-body border-top p-9">
            <div class="row">
                <div class="col-lg-12">
                    <div class="table-responsive viewList">
                        @include('layouts.search-component')
                        <table id="bedsAssigns" class="display table table-responsive-sm table-striped align-middle table-row-dashed fs-6 gy-5 gx-5 dataTable no-footer w-100">
                            <thead>
                            <tr class="text-start text-muted fw-bolder fs-7 text-uppercase gs-0">
                                <th class="w-15 text-start">{{ __('messages.bed_assign.case_id') }}</th>
                                <th class="w-15">{{ __('messages.case.patient') }}</th>
                                <th class="w-15">{{ __('messages.bed_assign.assign_date') }}</th>
                                <th class="w-15">{{ __('messages.bed_assign.discharge_date') }}</th>
                                <th class="w-10 text-center">{{ __('messages.common.status') }}</th>
                            </tr>
                            </thead>
                            <tbody class="fw-bold">
                            @foreach($bedAssigns as $bedAssign)
                                <tr>
                                    <td><span class="badge badge-light-info ">{{ $bedAssign->case_id }}</span></td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="symbol symbol-circle symbol-50px overflow-hidden me-3">
                                                <a href="{{ url('patients', $bedAssign->patient_id) }}">
                                                    <div>
                                                        <img src="{{ $bedAssign->patient->user->imageUrl }}" alt=""
                                                             class="user-img object-fit-cover">
                                                    </div>
                                                </a>
                                            </div>
                                            <div class="d-flex flex-column">
                                                <a href="{{ url('patients', $bedAssign->patient_id) }}"
                                                   class="mb-1">{{ $bedAssign->patient->user->full_name }}</a>
                                                <span>{{ $bedAssign->patient->user->email }}</span>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        @if(!empty($bedAssign->assign_date))
                                            <div class="badge badge-light">
                                                <div class="mb-2">{{ \Carbon\Carbon::parse($bedAssign->assign_date)->format('g:i A') }}</div>
                                                <div>{{ \Carbon\Carbon::parse($bedAssign->assign_date)->format('jS M, Y') }}</div>
                                            </div>
                                        @else
                                            N/A
                                        @endif
                                    </td>
                                    <td>{{ !empty($bedAssign->discharge_date)?date('jS M, Y g:i A', strtotime($bedAssign->discharge_date)):'N/A' }}</td>
                                    <td class="text-center"><span
                                            class="badge badge-light-{{!empty($bedAssign->status) ? 'success' : 'danger'}}">{{ ($bedAssign->status) ? __('messages.bed_assign.assigned') : __('messages.bed_assign.not_assigned') }}</span>
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
