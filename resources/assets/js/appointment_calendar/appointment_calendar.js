'use strict';

$(document).ready(function () {
    $('#patientIdAppointment, #doctorIdAppointment').select2({
        width: '100%',
    });

    let calendarEl = document.getElementById('calendar');

    screenLock();
    $.ajax({
        url: 'calendar-list',
        type: 'GET',
        dataType: 'json',
        success: function (obj) {
            screenUnLock();
            let calendar = new FullCalendar.Calendar(calendarEl, {
                themeSystem: 'bootstrap4',
                height: 750,
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,timeGridDay',
                },
                buttonText: {
                    today: todayText,
                    month: monthText,
                    week: weekText,
                    day: dayText,
                },
                initialDate: new Date(),
                initialView: 'dayGridMonth',
                editable: false,
                selectable: true,
                selectMirror: true,
                timeZone: 'UTC',
                dayMaxEvents: true,
                select: function (start) {
                    $('#opdDateAppointment').val(start.startStr);

                    let today = moment().format('YYYY-MM-DD');
                    if (start.startStr >= today) {
                        if (isDoctor != 1) {
                            $('#addAppointmentModal').modal('show');
                        }
                    }
                },
                eventDidMount: function (event, element) {
                    $(element).tooltip({
                        title: event.title,
                        container: 'body',
                    });
                },
                events: obj.data,
                eventTimeFormat: {
                    hour12: true,
                    hour: '2-digit',
                    minute: '2-digit',
                },
                loading: function (isLoading) {
                    if (!isLoading) {
                        setTimeout(function () {
                            $('#calendar button.fc-today-button').
                                removeClass('disabled').
                                prop('disabled', false);
                        }, 100);
                    }
                },
                eventClick: function (e) {
                    showAppointmentDetails(e.event.id);
                },
            });
            calendar.render();
        },
        error: function (result) {
            displayErrorMessage(result.message);
        },
    });

    window.showAppointmentDetails = function (appointmentId) {
        $.ajax({
            url: 'appointment-detail' + '/' + appointmentId,
            type: 'GET',
            beforeSend: function () {
                screenLock();
            },
            success: function (data) {
                $('#patientName').text(data.data.patient);
                $('#departmentName').text(data.data.department);
                $('#doctorName').text(data.data.doctor);
                $('#opdDate').text(data.data.opdDate);
                $('#status').text(data.data.status);
                $('#is_completed').text(data.data.is_completed);
                $('#problem').text(addNewlines(data.data.problem, 30));
                $('.tooltip ').tooltip('hide');
                $('#appointmentDetailModal').modal('show');
            },
            complete: function () {
                screenUnLock();
            },
        });
    };

    window.addNewlines = function (str, chr) {
        let result = '';
        if (str != null) {
            while (str.length > 0) {
                result += str.substring(0, chr) + '\n';
                str = str.substring(chr);
            }

            return result;
        } else
            return 'N/A';
    };

    //parseIn date_time
    window.parseIn = function (date_time) {
        let d = new Date();
        d.setHours(date_time.substring(11, 13));
        d.setMinutes(date_time.substring(14, 16));

        return d;
    };

    //make time slot list
    window.getTimeIntervals = function (time1, time2, duration) {
        let arr = [];
        while (time1 < time2) {
            arr.push(time1.toTimeString().substring(0, 5));
            time1.setMinutes(time1.getMinutes() + duration);
        }
        return arr;
    };

    //slot click change color
    let selectedTime;
    $(document).on('click', '.time-interval', function (event) {
        let appointmentId = $(event.currentTarget).data('id');
        if ($(this).data('id') == appointmentId) {
            if ($(this).parent().hasClass('booked')) {
                $('.time-slot-book').css('background-color', '#ffa0a0');
            }
        }
        selectedTime = ($(this).text());
        $('.time-slot').removeClass('time-slot-book');
        $(this).parent().addClass('time-slot-book');
    });

    //create appointment
    $('#calenderAppointmentForm').on('submit', function (event) {
        if (selectedTime == null || selectedTime == '') {
            $('#validationErrorsBox').
                show().
                html('Please select appointment time slot');
            return false;
        }
        event.preventDefault();
        screenLock();
        let formData = $(this).serialize() + '&time=' + selectedTime;
        $.ajax({
            url: calenderAppointmentSaveUrl,
            type: 'POST',
            dataType: 'json',
            data: formData,
            success: function (result) {
                displaySuccessMessage(result.message);
                window.location.href = calenderIndexPage;
            },
            error: function (result) {
                printErrorMessage('#validationErrorsBox', result);
                screenUnLock();
            },
        });
    });

    let doctorId;
    let doctorChange = false;
    let selectedDate;
    let intervals;
    let alreadyCreateTimeSlot;
    $('#doctorIdAppointment').on('change', function () {
        if (doctorChange) {
            $('.error-message').css('display', 'none');
            doctorChange = true;
        }
        $('.error-message').css('display', 'none');
        doctorId = $(this).val();
        doctorChange = true;
        if ($('#opdDateAppointment').val() !== '') {
            $('.doctor-schedule').css('display', 'none');
            $('.error-message').css('display', 'none');
            $('.available-slot-heading').css('display', 'none');
            $('.color-information').css('display', 'none');
            $('.time-slot').remove();

            if ($('#doctorIdAppintment').val() == '') {
                $('#validationErrorsBox').
                    show().
                    html('Please select Doctor');
                $('#validationErrorsBox').delay(5000).fadeOut();
                $('#opdDateAppointment').val('');
                $('#opdDateAppointment').data('DateTimePicker').clear();
                return false;
            }
            let weekday = [
                'Sunday',
                'Monday',
                'Tuesday',
                'Wednesday',
                'Thursday',
                'Friday',
                'Saturday'];
            selectedDate = $('#opdDateAppointment').val();
            let selected = new Date(selectedDate);
            let dayName = weekday[selected.getDay()];
            //if dayName is blank, then ajax call not run.
            if (dayName == null || dayName == '') {
                return false;
            }

            //get doctor schedule list with time slot.
            $.ajax({
                type: 'GET',
                url: doctorScheduleList,
                data: {
                    day_name: dayName,
                    doctor_id: doctorId,
                },
                success: function (result) {
                    if (result.success) {
                        if (result.data != '') {
                            if (result.data.scheduleDay.length != 0) {
                                let doctorStartTime = selectedDate + ' ' +
                                    result.data.scheduleDay[0].available_from;
                                let doctorEndTime = selectedDate + ' ' +
                                    result.data.scheduleDay[0].available_to;
                                let doctorPatientTime = result.data.perPatientTime[0].per_patient_time;

                                //perPatientTime convert to Minuter
                                let a = doctorPatientTime.split(':'); // split it at the colons
                                let minutes = (+a[0]) * 60 + (+a[1]); // convert to minute

                                //parse In
                                let startTime = parseIn(doctorStartTime);
                                let endTime = parseIn(doctorEndTime);

                                //call to getTimeIntervals function
                                intervals = getTimeIntervals(startTime, endTime,
                                    minutes);

                                //if intervals array length is grater then 0 then process
                                if (intervals.length > 0) {
                                    $('.available-slot-heading').
                                        css('display', 'block');
                                    $('.color-information').
                                        css('display', 'block');
                                    let index;
                                    let timeStlots = '';
                                    for (index = 0; index <
                                    intervals.length; ++index) {
                                        let data = [
                                            {
                                                'index': index,
                                                'timeSlot': intervals[index],
                                            }];
                                        let timeSlot = prepareTemplateRender(
                                            '#appointmentSlotTemplate', data);
                                        timeStlots += timeSlot;
                                    }
                                    $('.available-slot').append(timeStlots);
                                }

                                // display Day Name and time
                                if ((result.data.scheduleDay[0].available_from !=
                                        '00:00:00' &&
                                        result.data.scheduleDay[0].available_to !=
                                        '00:00:00') &&
                                    (doctorStartTime != doctorEndTime)) {
                                    $('.doctor-schedule').
                                        css('display', 'block');
                                    $('.color-information').
                                        css('display', 'block');
                                    $('.day-name').
                                        html(
                                            result.data.scheduleDay[0].available_on);
                                    $('.schedule-time').
                                        html('[' +
                                            result.data.scheduleDay[0].available_from +
                                            ' - ' +
                                            result.data.scheduleDay[0].available_to +
                                            ']');
                                } else {
                                    $('.doctor-schedule').
                                        css('display', 'none');
                                    $('.color-information').
                                        css('display', 'none');
                                    $('.error-message').css('display', 'block');
                                    $('.error-message').
                                        html(
                                            'Doctor Schedule not available this date.');
                                }
                            } else {
                                $('.doctor-schedule').css('display', 'none');
                                $('.color-information').css('display', 'none');
                                $('.error-message').css('display', 'block');
                                $('.error-message').
                                    html(
                                        'Doctor Schedule not available this date.');
                            }
                        }
                    }
                },
            });

            if (isCreate) {
                let delayCall = 200;
                setTimeout(getCreateTimeSlot, delayCall);

                function getCreateTimeSlot () {
                    let data = null;
                    if (isCreate) {
                        data = {
                            editSelectedDate: selectedDate,
                            doctor_id: doctorId,
                        };
                    }
                    $.ajax({
                        url: getBookingSlot,
                        type: 'GET',
                        data: data,
                        success: function (result) {
                            alreadyCreateTimeSlot = result.data.bookingSlotArr;
                            if (result.data.hasOwnProperty('onlyTime')) {
                                if (result.data.bookingSlotArr.length > 0) {
                                    editTimeSlot = result.data.onlyTime.toString();
                                    $.each(result.data.bookingSlotArr,
                                        function (index, value) {
                                            $.each(intervals, function (i, v) {
                                                if (value == v) {
                                                    $('.time-interval').
                                                        each(function () {
                                                            if ($(this).
                                                                    data('id') ==
                                                                i) {
                                                                if ($(this).
                                                                        html() !=
                                                                    editTimeSlot) {
                                                                    $(this).
                                                                        parent().
                                                                        css(
                                                                            {
                                                                                'background-color': '#ffa721',
                                                                                'border': '1px solid #ffa721',
                                                                                'color': '#ffffff',
                                                                            });
                                                                    $(this).
                                                                        parent().
                                                                        addClass(
                                                                            'booked');
                                                                    $(this).
                                                                        parent().
                                                                        children().
                                                                        prop(
                                                                            'disabled',
                                                                            true);
                                                                }
                                                            }
                                                        });
                                                }
                                            });
                                        });
                                }
                                $('.time-interval').each(function () {
                                    if ($(this).html() == editTimeSlot &&
                                        result.data.bookingSlotArr.length > 0) {
                                        $(this).
                                            parent().
                                            addClass('time-slot-book');
                                        $(this).parent().removeClass('booked');
                                        $(this).
                                            parent().
                                            children().
                                            prop('disabled', false);
                                        $(this).click();
                                    }
                                });
                            } else if (alreadyCreateTimeSlot.length > 0) {
                                $.each(alreadyCreateTimeSlot,
                                    function (index, value) {
                                        $.each(intervals, function (i, v) {
                                            if (value == v) {
                                                $('.time-interval').
                                                    each(function () {
                                                        if ($(this).
                                                                data('id') ==
                                                            i) {
                                                            $(this).
                                                                parent().
                                                                addClass(
                                                                    'time-slot-book');
                                                            $('.time-slot-book').
                                                                css(
                                                                    {
                                                                        'background-color': '#ffa721',
                                                                        'border': '1px solid #ffa721',
                                                                        'color': '#ffffff',
                                                                    });
                                                            $(this).
                                                                parent().
                                                                addClass(
                                                                    'booked');
                                                            $(this).
                                                                parent().
                                                                children().
                                                                prop('disabled',
                                                                    true);
                                                        }
                                                    });
                                            }
                                        });
                                    });
                            }
                        },
                    });
                }
            }
        }
    });

    // reset the modal data after cancel/close
    $('#addAppointmentModal').on('hidden.bs.modal', function () {
        resetModalForm('#calenderAppointmentForm', '#validationErrorsBox');
        $('.day-name').html('');
        $('.schedule-time').html('');
        $('.doctor-schedule').css('display', 'none');
        $('.error-message').css('display', 'none');
        $('.available-slot-heading').css('display', 'none');
        $('.available-slot').html('');
        $('.color-information').css('display', 'none');
        selectedTime = null;
    });
});
