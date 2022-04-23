<div>

    <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" id="poverview" role="tabpanel">
            <div class="card mb-5 mb-xl-10">
                <div class="card-header border-0">
                    <div class="card-title m-0">
                        <h3 class="fw-bolder m-0 me-8">{{__('messages.bed_status.bed_status')}}</h3>
                        <i class="fas fa-procedures fa-1x assigned-bed"></i><label
                            class="fw-bolder mx-1">:</label><label
                            class="fw-bold text-muted me-2 fs-5">{{__('messages.bed_status.assigned_beds')}}</label>

                        <i class="fas fa-bed fa-1x unassigned-bed"></i><label class="fw-bolder mx-1">:</label><label
                            class="fw-bold text-muted fs-5">{{__('messages.bed_status.available_beds')}}</label>
                    </div>
                    <div class="d-flex align-items-center py-1">
                        <a href="{{ url()->previous() }}"
                           class="btn btn-sm btn-light btn-active-light-primary pull-right">{{ __('messages.common.back') }}</a>
                    </div>
                </div>
                <div>
                    <div class="card-body border-top p-9">
                        @foreach($bedTypes as $bedType)
                            <div class="py-2">
                                <label class="fw-boldest text-muted">{{$bedType->title}}</label>
                            </div>
                            <hr>
                            <div class="row">
                                @if(count($bedType->beds)>0)
                                    @foreach($bedType->beds as $bed)
                                        <div class="col-md-2">
                                            <div class="text-center">
                                                @if(!$bed->bedAssigns->isEmpty() && !$bed->is_available && $bed->bedAssigns[0]->discharge_date == null)
                                                    <div class="bad-status-hover">
                                                        <a href="#">
                                                            <i class="fas fa-procedures fa-3x assigned-bed"></i>
                                                        </a>
                                                        <div class="bed-status-popup">
                                                            <label
                                                                class="fw-bold">{{__('messages.bed_status.bed_name')}}
                                                                :</label> {{$bed->name}}
                                                            <br>
                                                            <label class="fw-bold">{{__('messages.case.patient')}}
                                                                :</label> {{$bed->bedAssigns[0]->patient->user->full_name}}
                                                            <br>
                                                            <label class="fw-bold">{{__('messages.bed_status.phone')}}
                                                                :</label> {{!empty($bed->bedAssigns[0]->patient->user->phone)?$bed->bedAssigns[0]->patient->user->phone:'N/A'}}
                                                            <br>
                                                            <label
                                                                class="fw-bold">{{__('messages.bed_status.admission_date')}}
                                                                :</label> {{date('jS M, Y h:i:s A', strtotime($bed->bedAssigns[0]->assign_date))}}
                                                            <br>
                                                            <label class="fw-bold">{{__('messages.bed_status.gender')}}
                                                                :</label> {{($bed->bedAssigns[0]->patient->user->gender === 0)? 'Male' : 'Female' }}
                                                        </div>
                                                    </div>
                                                    <div class="pt-1">
                                                        <label
                                                            class="assigned-bed">{{$bed->bedAssigns[0]->patient->user->full_name}}</label>
                                                    </div>
                                                @else
                                                    @php
                                                        $isTrue = true;
                                                    @endphp
                                                    @foreach($patientAdmissions as $patientAdmission)
                                                        @if($patientAdmission->bed->id == $bed->id && !$patientAdmission->bed->is_available && ($patientAdmission->discharge_date == null))
                                                            @php
                                                                $isTrue = false;
                                                            @endphp
                                                            <div class="bad-status-hover">
                                                                <a href="#">
                                                                    <i class="fas fa-procedures fa-3x assigned-bed"></i>
                                                                </a>
                                                                <div class="bed-status-popup">
                                                                    <label
                                                                        class="fw-bold">{{__('messages.bed_status.bed_name')}}
                                                                        :</label> {{$bed->name}}
                                                                    <br>
                                                                    <label
                                                                        class="fw-bold">{{__('messages.case.patient')}}
                                                                        :</label> {{$patientAdmission->patient->user->full_name}}
                                                                    <br>
                                                                    <label
                                                                        class="fw-bold">{{__('messages.bed_status.phone')}}
                                                                        :</label> {{!empty($patientAdmission->patient->user->phone)?$patientAdmission->patient->user->phone:'N/A'}}
                                                                    <br>
                                                                    <label
                                                                        class="fw-bold">{{__('messages.bed_status.admission_date')}}
                                                                        :</label> {{date('jS M, Y h:i:s A', strtotime($patientAdmission->admission_date))}}
                                                                    <br>
                                                                    <label
                                                                        class="fw-bold">{{__('messages.bed_status.gender')}}
                                                                        :</label> {{($patientAdmission->patient->user->gender === 0)? 'Male' : 'Female' }}
                                                                </div>
                                                            </div>
                                                            <div class="pt-1">
                                                                <label
                                                                    class="assigned-bed">{{$patientAdmission->patient->user->full_name}}</label>
                                                            </div>
                                                        @endif
                                                    @endforeach
                                                    @if($isTrue == true)
                                                        <a href="{{route('bed-assigns.create', ['bed_id' => $bed->id])}}">
                                                            <i class="fas fa-bed fa-3x unassigned-bed"></i>
                                                            <div>
                                                                <strong class="unassigned-bed">{{$bed->name}} </strong>
                                                            </div>
                                                        </a>
                                        @endif
                                    @endif
                                </div>
                                        </div>
                                    @endforeach
                                @else
                                    <div class="no-bed-available">
                                        <span class="fw-bolder fs-7">No bed available.</span>
                                    </div>
                                @endif
                            </div>
                            <hr class="bed-section">
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

