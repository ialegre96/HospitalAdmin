<div>
    <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" id="poverview" role="tabpanel">
            <div class="card mb-5 mb-xl-10">
                <div class="card-header border-0">
                    <div class="card-title m-0">
                        <h3 class="fw-bolder m-0">{{__('messages.doctor_department.doctor_department_details')}}</h3>
                    </div>
                    <div class="d-flex align-items-center py-1">
                        @if (!Auth::user()->hasRole('Doctor|Patient|Receptionist'))
                            <a class="btn btn-sm btn-primary me-2 edit-btn"
                               data-id="{{ $doctorDepartment->id }}">{{ __('messages.common.edit') }}</a>
                        @endif
                        <a href="{{ url()->previous() }}"
                           class="btn btn-sm btn-light btn-active-light-primary pull-right">{{ __('messages.common.back') }}</a>
                    </div>
                </div>
                <div>
                    <div class="card-body  border-top p-9">
                        <div class="row mb-7">
                            <div class="col-lg-4 col-md-6 col-sm-2 d-flex flex-column">
                                {{ Form::label('title', __('messages.appointment.doctor_department').(':'), ['class' => 'fw-bold text-muted py-3']) }}
                                <span class="fw-bolder fs-6 text-gray-800">{{ $doctorDepartment->title }}</span>
                            </div>
                            <div class="col-lg-4 col-md-6 col-sm-2 d-flex flex-column">
                                {{ Form::label('created at', __('messages.common.created_on').(':'), ['class' => 'fw-bold text-muted py-3']) }}
                                <span class="fw-bolder fs-6 text-gray-800" data-toggle="tooltip" data-placement="right" title="{{ date('jS M, Y', strtotime($doctorDepartment->created_at)) }}">{{ $doctorDepartment->created_at->diffForHumans() }}</span>
                            </div>
                            <div class="col-lg-4 col-md-6 col-sm-2 d-flex flex-column">
                                {{ Form::label('updated at', __('messages.common.last_updated').(':'), ['class' => 'fw-bold text-muted py-3']) }}
                                <span class="fw-bolder fs-6 text-gray-800" data-toggle="tooltip" data-placement="right" title="{{ date('jS M, Y', strtotime($doctorDepartment->updated_at)) }}">{{ $doctorDepartment->updated_at->diffForHumans() }}</span>
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12 d-flex flex-column">
                                {{ Form::label('description', __('messages.doctor_department.description').(':'), ['class' => 'fw-bold text-muted py-3']) }}
                                <span class="fw-bolder fs-6 text-gray-800">{!! (!empty($doctorDepartment->description)) ? nl2br(e($doctorDepartment->description)) : __('messages.common.n/a') !!}</span>
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
                <h3 class="fw-bolder m-0">{{ __('messages.doctors') }}</h3>
            </div>
        </div>
        <div>
            <div class="card-body border-top p-9">
                <div class="row">
                    <div class="col-lg-12">
                        @include('layouts.search-component')
                        <div class="table-responsive viewList">
                            <table id="doctorsDepartmentList"
                                   class="display table table-responsive-sm table-striped align-middle table-row-dashed fs-6 gy-5 gx-5 dataTable no-footer w-100">
                                <thead>
                                <tr class="text-start text-muted fw-bolder fs-7 text-uppercase gs-0">
                                    <th>{{ __('messages.case.doctor') }}</th>
                                    <th>{{ __('messages.doctor.specialist') }}</th>
                                    <th>{{ __('messages.user.phone') }}</th>
                                    <th>{{ __('messages.user.qualification') }}</th>
                                    <th class="text-center">{{ __('messages.common.status') }}</th>
                                </tr>
                                </thead>
                                <tbody class="fw-bold">
                                @forelse($doctors as $doctor)
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="symbol symbol-circle symbol-50px overflow-hidden me-3">
                                                    <a href="{{ url('doctors/'.$doctor->id) }}">
                                                        <div>
                                                            <img src="{{ $doctor->user->image_url }}" alt=""
                                                                 class="user-img">
                                                        </div>
                                                    </a>
                                                </div>
                                                <div class="d-flex flex-column">
                                                    <a href="{{ url('doctors/'.$doctor->id) }}"
                                                       class="mb-1">{{ $doctor->user->full_name }}</a>
                                                    <span>{{ $doctor->user->email }}</span>
                                                </div>
                                            </div>
                                        </td>
                                        <td>{{ $doctor->specialist }}</td>
                                        <td>{{ (!empty($doctor->user->phone)) ? $doctor->user->phone : __('messages.common.n/a') }}</td>
                                        <td>{{ $doctor->user->qualification }}</td>
                                        <td class="text-center">
                                            <span
                                                class="badge badge-light-{{($doctor->user->status == 1) ? 'success' : 'danger'}}">{{ ($doctor->user->status) ? __('messages.common.active') : __('messages.common.de_active') }}</span>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td class="text-center" colspan="6">No data available in table</td>
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
