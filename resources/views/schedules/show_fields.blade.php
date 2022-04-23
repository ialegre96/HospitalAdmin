<div>
    <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" id="poverview" role="tabpanel">
            <div class="card mb-5 mb-xl-10">
                <div class="card-header border-0">
                    <div class="card-title m-0">
                        <h3 class="fw-bolder m-0">{{__('messages.schedule.details')}}</h3>
                    </div>
                    <div class="d-flex align-items-center py-1">
                        <a class="btn btn-sm btn-primary me-2"
                           href="{{ route('schedules.edit',['schedule' => $schedule->id])}}">{{ __('messages.common.edit') }}</a>
                        <a href="{{route('schedules.index') }}"
                           class="btn btn-sm btn-light btn-active-light-primary pull-right">{{ __('messages.common.back') }}</a>
                    </div>
                </div>
                <div>
                    <div class="card-body  border-top p-9">
                        <div class="row mb-7">
                            <div class="col-lg-3 col-md-6 col-sm-2 d-flex flex-column">
                                {{ Form::label('doctor_name', __('messages.case.doctor').(':'), ['class' => 'fw-bold text-muted py-3']) }}
                                <span class="fw-bolder fs-6 text-gray-800">{{$schedule->doctor->user->full_name}}</span>
                            </div>
                            <div class="col-lg-3 col-md-6 col-sm-2 d-flex flex-column">
                                {{ Form::label('per_patient_time', __('messages.schedule.per_patient_time').(':'), ['class' => 'fw-bold text-muted py-3']) }}
                                <span class="fw-bolder fs-6 text-gray-800">{{ date('H:i', strtotime($schedule->per_patient_time))}}</span>
                            </div>
                            <div class="col-lg-3 col-md-6 col-sm-2 d-flex flex-column">
                                {{ Form::label('created_on', __('messages.common.created_on').(':'), ['class' => 'fw-bold text-muted py-3']) }}
                                <span class="fw-bolder fs-6 text-gray-800" data-toggle="tooltip" data-placement="right" title="{{ date('jS M, Y', strtotime($schedule->created_at)) }}">{{ $schedule->created_at->diffForHumans() }}</span>
                            </div>
                            <div class="col-lg-3 col-md-6 col-sm-2 d-flex flex-column">
                                {{ Form::label('last_updated', __('messages.common.last_updated').(':'), ['class' => 'fw-bold text-muted py-3']) }}
                                <span class="fw-bolder fs-6 text-gray-800" data-toggle="tooltip" data-placement="right" title="{{ date('jS M, Y', strtotime($schedule->updated_at)) }}">{{ $schedule->updated_at->diffForHumans() }}</span>
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
                <h3 class="fw-bolder m-0">{{ __('messages.schedule_label') }}</h3>
            </div>
        </div>
        <div>
            <div class="card-body border-top p-9">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="table-responsive viewList">
                            <table id="accountInvoice" class="display table table-responsive-sm table-striped align-middle table-row-dashed fs-6 gy-5 gx-5 dataTable no-footer w-100">
                                <thead>
                                <tr class="text-start text-muted fw-bolder fs-7 text-uppercase gs-0">
                                    <th>{{ __('messages.schedule.available_on') }}</th>
                                    <th>{{ __('messages.schedule.available_from') }}</th>
                                    <th>{{ __('messages.schedule.available_to') }}</th>
                                </tr>
                                </thead>
                                <tbody class="fw-bold">
                                @forelse($scheduleDays as $scheduleDay)
                                    <tr>
                                        <td>{{ $scheduleDay->available_on }}</td>
                                        <td>{{ date('H:i A', strtotime($scheduleDay->available_from)) }}</td>
                                        <td>{{ date('H:i A', strtotime($scheduleDay->available_to)) }}</td>
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
</div>
