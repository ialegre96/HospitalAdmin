<div class="row gx-10 mb-9">
    <div class="col-12">
        <div class="main-card-section p-0">
            @foreach($weekDay as $day => $shortWeekDay)
                @php($isValid = $hospitalSchedules->where('day_of_week',$day)->count() != 0)
                <div class="weekly-content" data-day="{{$day}}">
                    <div class="d-flex w-100 align-items-center position-relative">
                        <div class="d-flex flex-md-row flex-column w-100 weekly-row">
                            <div
                                class="form-check form-check-custom form-check-solid mb-0 checkbox-content d-flex align-items-center">
                                <input id="chkShortWeekDay_{{$shortWeekDay}}" class="form-check-input" type="checkbox"
                                       value="{{$day}}" name="checked_week_days[]"
                                       @if($isValid)
                                       checked="checked" @endif>
                                <label class="form-check-label" for="chkShortWeekDay_{{$shortWeekDay}}">
                                    <span class="fs-5 fw-bold d-md-block d-none">{{$shortWeekDay}}</span>
                                </label>
                            </div>
                            <div class="session-times">
                                @if($hospitalSchedule = $hospitalSchedules->where('day_of_week',$day)->first())
                                    @include('hospital_schedule.slot',['slot' => $slots,'day' => $day,'hospitalSchedule' => $hospitalSchedule])
                                @else
                                    @include('hospital_schedule.slot',['slot' => $slots,'day' => $day])
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
<div>
    {{ Form::button(__('messages.common.save'), ['type' => 'submit','class' => 'btn btn-primary', 'id' => 'btnSave','data-loading-text' => "<span class='spinner-border spinner-border-sm'></span> Processing..."]) }}
</div>
