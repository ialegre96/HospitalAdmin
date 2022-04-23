'use strict';

$(document).ready(function () {
    $('#patientId').selectize();
    $('#departmentId').selectize();
    $('#doctorId').selectize();
    let doctor = $('#doctor').val();
    let appointmentDate = $('#appointmentDate').val();

    var selectedDate;
    var intervals;
    var alreadyCreateTimeSlot;

    let opdDate = $('#opdDate').datepicker({
        useCurrent: false,
        sideBySide: true,
        minDate: new Date(),
        onSelect: function (selectedDate, dateStr) {
            let selectDate = selectedDate;
            $('.doctor-schedule').css('display', 'none');
            $('.error-message').css('display', 'none');
            $('.available-slot-heading').css('display', 'none');
            $('.color-information').css('display', 'none');
            $('.time-slot').remove();
            if ($('#departmentId').val() == '') {
                $('#validationErrorsBox').
                    show().
                    html('Please select Doctor Department');
                $('#validationErrorsBox').delay(5000).fadeOut();
                $('#opdDate').val('');
                // opdDate.clear();
                return false;
            } else if ($('#doctorId').val() == '') {
                $('#validationErrorsBox').show().html('Please select Doctor');
                $('#validationErrorsBox').delay(5000).fadeOut();
                $('#opdDate').val('');
                // opdDate.clear();
                return false;
            }
            var weekday = [
                'Sunday',
                'Monday',
                'Tuesday',
                'Wednesday',
                'Thursday',
                'Friday',
                'Saturday'];
            var selected = new Date(selectedDate);
            let dayName = weekday[selected.getDay()];
            selectedDate = dateStr;

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
                                let availableFrom = '';
                                if (moment(new Date()).format('MM/DD/YYYY') ===
                                    selectDate) {
                                    availableFrom = moment(new Date()).
                                        format('H:mm:ss');
                                } else {
                                    availableFrom = result.data.scheduleDay[0].available_from;
                                }
                                var doctorStartTime = selectedDate + ' ' +
                                    availableFrom;
                                var doctorEndTime = selectedDate + ' ' +
                                    result.data.scheduleDay[0].available_to;
                                var doctorPatientTime = result.data.perPatientTime[0].per_patient_time;

                                //perPatientTime convert to Minute
                                var a = doctorPatientTime.split(':'); // split it at the colons
                                var minutes = (+a[0]) * 60 + (+a[1]); // convert to minute

                                //parse In
                                var startTime = parseIn(doctorStartTime);
                                var endTime = parseIn(doctorEndTime);

                                //call to getTimeIntervals function
                                intervals = getTimeIntervals(startTime, endTime,
                                    minutes);

                                //if intervals array length is grater then 0 then process
                                if (intervals.length > 0) {
                                    $('.available-slot-heading').css('display', 'block');
                                    $('.color-information').
                                        css('display', 'block');
                                    $('.available-slot').
                                        css('display', 'block');
                                    var index;
                                    let timeStlots = '';
                                    for (index = 0; index <
                                    intervals.length; ++index) {
                                        let data = [
                                            {
                                                'index': index,
                                                'timeSlot': intervals[index],
                                            }];
                                        var timeSlot = prepareTemplateRender(
                                            '#appointmentSlotTemplate', data);
                                        timeStlots += timeSlot;
                                    }
                                    $('.available-slot').append(timeStlots);
                                }

                                // display Day Name and time
                                if ((availableFrom !=
                                        '00:00:00' &&
                                        result.data.scheduleDay[0].available_to !=
                                        '00:00:00') &&
                                    (doctorStartTime != doctorEndTime)) {
                                    $('.doctor-schedule').
                                        css('display', 'block');
                                    $('.color-information').
                                        css('display', 'block');
                                    $('.available-slot').
                                        css('display', 'block');
                                    $('.day-name').html(
                                        result.data.scheduleDay[0].available_on);
                                    $('.schedule-time').html('[' +
                                        availableFrom +
                                        ' - ' +
                                        result.data.scheduleDay[0].available_to +
                                        ']');
                                } else {
                                    $('.doctor-schedule').
                                        css('display', 'none');
                                    $('.color-information').
                                        css('display', 'none');
                                    $('.error-message').css('display', 'none');
                                    $('.available-slot').css('display', 'none');
                                    $('.error-message').html(
                                        'Doctor Schedule not available this date.');
                                }
                            } else {
                                $('.doctor-schedule').css('display', 'none');
                                $('.color-information').css('display', 'none');
                                $('.error-message').css('display', 'block');
                                $('.error-message').html(
                                    'Doctor Schedule not available this date.');
                            }
                        }
                    }
                },
            });
            /*
            if (isCreate || isEdit) {
                var delayCall = 200;
                setTimeout(getCreateTimeSlot, delayCall);

                function getCreateTimeSlot() {
                    if (isCreate) {
                        var data = {
                            editSelectedDate: selectedDate,
                            doctor_id: doctorId,
                        };
                    } else {
                        var data = {
                            editSelectedDate: selectedDate,
                            editId: appointmentEditId,
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
                                                    $('.time-interval').each(function () {
                                                        if ($(this).data('id') == i) {
                                                            if ($(this).html() !=
                                                                editTimeSlot) {
                                                                $(this).parent().css({
                                                                    'background-color': '#ffa721',
                                                                    'border': '1px solid #ffa721',
                                                                    'color': '#ffffff',
                                                                });
                                                                $(this).parent().addClass(
                                                                    'booked');
                                                                $(this).parent().children().prop(
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
                                        $(this).parent().addClass('time-slot-book');
                                        $(this).parent().removeClass('booked');
                                        $(this).parent().children().prop('disabled', false);
                                        $(this).click();
                                    }
                                });
                            } else if (alreadyCreateTimeSlot.length > 0) {
                                $.each(alreadyCreateTimeSlot,
                                    function (index, value) {
                                        $.each(intervals, function (i, v) {
                                            if (value == v) {
                                                $('.time-interval').each(function () {
                                                    if ($(this).data('id') ==
                                                        i) {
                                                        $(this).parent().addClass(
                                                            'time-slot-book');
                                                        $('.time-slot-book').css({
                                                            'background-color': '#ffa721',
                                                            'border': '1px solid #ffa721',
                                                            'color': '#ffffff',
                                                        });
                                                        $(this).parent().addClass('booked');
                                                        $(this).parent().children().prop('disabled',
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
            
             */
        },
    });
    $('#patientId').first().focus();
    // document.querySelector('#ipdEditChargeDate')._flatpickr.setDate(moment(result.data.date).format());

    $('#departmentId').on('change', function () {
        $('.error-message').css('display', 'none');
        var selectize = $('#doctorId')[0].selectize;
        selectize.clearOptions();
        $('#opdDate').val('');
        // opdDate.clear();
        $('.doctor-schedule').css('display', 'none');
        $('.available-slot-heading').css('display', 'none');
        $('.available-slot').css('display', 'none');
        $.ajax({
            url: doctorDepartmentUrl,
            type: 'get',
            dataType: 'json',
            data: { id: $(this).val() },
            success: function (data) {
                $('#doctorId').empty();
                $('#doctorId').
                    append($('<option value="">Select Doctor</option>'));
                $.each(data.data, function (i, v) {
                    $('#doctorId').append($('<option></option>').attr('value', i).text(v));
                });
                let $select = $(document.getElementById('doctorId')).selectize();
                let selectize = $select[0].selectize;
                $.each(data.data, function (i, v) {
                    selectize.addOption({value: i, text: v});
                });
                selectize.refreshOptions();
            },
        });
    });

    var doctorId;
    let doctorChange = false;
    $('#doctorId').on('change', function () {
        if (doctorChange) {
            $('.error-message').css('display', 'none');
            // opdDate.clear();
            $('.doctor-schedule').css('display', 'none');
            $('.error-message').css('display', 'none');
            $('.available-slot-heading').css('display', 'none');
            $('.color-information').css('display', 'none');
            $('.time-slot').remove();
            $('.available-slot').css('display', 'none');
            doctorChange = true;
        }
        $('.error-message').css('display', 'none');
        doctorId = $(this).val();
        doctorChange = true;
    });

    // if edit record then trigger change
    var editTimeSlot;
    if (isEdit) {
        $('#doctorId').trigger('change', function (event) {
            doctorId = $(this).val();
        });

        $('#opdDate').trigger('dp.change', function () {
            var selected = new Date($(this).val());
        });
    }

    //parseIn date_time
    window.parseIn = function (date_time) {
        var d = new Date();
        d.setHours(date_time.substring(16, 18));
        d.setMinutes(date_time.substring(19, 21));

        return d;
    };

    //make time slot list
    window.getTimeIntervals = function (time1, time2, duration) {
        var arr = [];
        while (time1 < time2) {
            arr.push(time1.toTimeString().substring(0, 5));
            time1.setMinutes(time1.getMinutes() + duration);
        }
        return arr;
    };

    //slot click change color
    var selectedTime;
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

    var editTimeSlot;
    $(document).on('click', '.time-interval', function () {
        editTimeSlot = ($(this).text());
    });

    let oldPatient = false;
    $(document).on('change', '.new-patient-radio', function () {
        if ($(this).is(':checked')) {
            $('.old-patient').addClass('d-none');
            $('.first-name-div').removeClass('d-none');
            $('.last-name-div').removeClass('d-none');
            $('.gender-div').removeClass('d-none');
            $('.password-div').removeClass('d-none');
            $('.confirm-password-div').removeClass('d-none');
            $('#firstName').prop('required', true);
            $('#lastName').prop('required', true);
            $('#password').prop('required', true);
            $('#confirmPassword').prop('required', true);
            oldPatient = false;
        }
    });

    $(document).on('change', '.old-patient-radio', function () {
        if ($(this).is(':checked')) {
            $('.old-patient').removeClass('d-none');
            $('.first-name-div').addClass('d-none');
            $('.last-name-div').addClass('d-none');
            $('.gender-div').addClass('d-none');
            $('.password-div').addClass('d-none');
            $('.confirm-password-div').addClass('d-none');
            $('#firstName').prop('required', false);
            $('#lastName').prop('required', false);
            $('#password').prop('required', false);
            $('#confirmPassword').prop('required', false);
            oldPatient = true;
        }
    });

    $(document).on('focusout', '.old-patient-email', function () {
        let email = $('.old-patient-email').val();
        if (oldPatient && email != null) {
            $.ajax({
                url: route('appointment.patient.details', email),
                type: 'get',
                success: function (result) {
                    if (result.data != null) {
                        $('#patient').empty();
                        $.each(result.data, function (index, value) {
                            $('#patientName').val(value);
                            $('#patient').val(index);
                        });
                    } else {
                        displayErrorMessage(
                            'Patient not exists or status is not active.');
                    }
                },
            });
        }
    });

    //create appointment
    $('#appointmentForm').on('submit', function (event) {
        event.preventDefault();
        showScreenLoader();
        if (!oldPatient) {
            let isValidate = validatePassword();
            if (!isValidate) {
                hideScreenLoader();
                return false;
            }
        }

        if (selectedTime == null || selectedTime == '') {
            displayErrorMessage('Please select appointment time slot');
            hideScreenLoader();
            return false;
        }
        // screenLock();
        let formData = $(this).serialize() + '&time=' + selectedTime;
        $.ajax({
            url: appointmentSaveUrl,
            type: 'POST',
            dataType: 'json',
            data: formData,
            success: function (result) {
                hideScreenLoader();
                displaySuccessMessage(result.message);
                setTimeout(function () {
                    location.reload();
                }, 4000);
                if (isGoogleCaptchaEnabled) {
                    grecaptcha.reset();
                }
            },
            error: function (result) {
                printErrorMessage('#validationErrorsBox', result);
                $('.alert').delay(5000).slideUp(300);
                hideScreenLoader();
                if (isGoogleCaptchaEnabled) {
                    grecaptcha.reset();
                }
            },
        });
    });

    function showScreenLoader () {
        $('#overlay-screen-lock').removeClass('d-none');
    }

    function hideScreenLoader () {
        $('#overlay-screen-lock').addClass('d-none');
    }

    function validatePassword () {
        let password = $('#password').val();
        let confirmPassword = $('#confirmPassword').val();

        if (password == '' || confirmPassword == '') {
            displayErrorMessage('Please fill all the required fields.');
            return false;
        }

        if (password !== confirmPassword) {
            displayErrorMessage('Password and Confirm password not match.');
            return false;
        }

        return true;
    }

    $(document).on('click', '#reset', function () {
        $(this).
            closest('#appointmentForm').
            find(
                'input[type=text], input[type=password], input[type=email], textarea').
            val('');
        $('#patientId, #doctorId, #departmentId').
            val('').
            trigger('change.select2');
    });

    $(document).on('keypress', '#firstName, #lastName', function (e) {
        if (e.which === 32)
            return false;
    });
    $.ajax({
        url: doctorUrl,
        type: 'get',
        dataType: 'json',
        data: { id: doctor },
        success: function (data) {
            $('#doctorId').empty();
            let $select = $(document.getElementById('doctorId')).selectize();
            let selectize = $select[0].selectize;
            $.each(data.data, function (i, v) {
                selectize.addOption({ value: i, text: v });
                selectize.setValue(i);
            });
        },
    });
    opdDate.datepicker('setDate', appointmentDate);
    if (opdDate !== null) {
        opdDate instanceof Date;
        let dateStr = opdDate;
        let selectedDate = appointmentDate;
        $('.doctor-schedule').css('display', 'none');
        $('.error-message').css('display', 'none');
        $('.available-slot-heading').css('display', 'none');
        $('.color-information').css('display', 'none');
        $('.time-slot').remove();
        // if ($('#departmentId').val() == '') {
        //     $('#validationErrorsBox').
        //         show().
        //         html('Please select Doctor Department');
        //     $('#validationErrorsBox').delay(5000).fadeOut();
        //     $('#opdDate').val('');
        //     // opdDate.clear();
        //     return false;
        // } else if ($('#doctorId').val() == '') {
        //     $('#validationErrorsBox').show().html('Please select Doctor');
        //     $('#validationErrorsBox').delay(5000).fadeOut();
        //     $('#opdDate').val('');
        //     // opdDate.clear();
        //     return false;
        // }
        var weekday = [
            'Sunday',
            'Monday',
            'Tuesday',
            'Wednesday',
            'Thursday',
            'Friday',
            'Saturday'];
        var selected = new Date(selectedDate);
        let dayName = weekday[selected.getDay()];
        selectedDate = dateStr;

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
                doctor_id: doctor,
            },
            success: function (result) {
                if (result.success) {
                    if (result.data != '') {
                        if (result.data.scheduleDay.length != 0) {
                            let availableFrom = '';
                            if (moment(new Date()).format('MM/DD/YYYY') ===
                                appointmentDate) {
                                availableFrom = moment().ceil(moment.duration( result.data.perPatientTime[0].per_patient_time).asMinutes()
                                    , 'minute');
                                availableFrom = moment(availableFrom.toString()).format('H:mm:ss');
                                // availableFrom = moment(new Date()).
                                //     add(result.data.perPatientTime[0].per_patient_time,
                                //         'minutes').format('H:mm:ss');
                            } else {
                                availableFrom = result.data.scheduleDay[0].available_from;
                            }
                            var doctorStartTime = selectedDate + ' ' +
                                availableFrom;
                            var doctorEndTime = selectedDate + ' ' +
                                result.data.scheduleDay[0].available_to;
                            var doctorPatientTime = result.data.perPatientTime[0].per_patient_time;

                            //perPatientTime convert to Minute
                            var a = doctorPatientTime.split(':'); // split it at the colons
                            var minutes = (+a[0]) * 60 + (+a[1]); // convert to minute

                            //parse In
                            var startTime = parseIn(doctorStartTime);
                            var endTime = parseIn(doctorEndTime);

                            //call to getTimeIntervals function
                            intervals = getTimeIntervals(startTime, endTime,
                                minutes);

                            //if intervals array length is grater then 0 then process
                            if (intervals.length > 0) {
                                $('.available-slot-heading').
                                    css('display', 'block');
                                $('.color-information').css('display', 'block');
                                var index;
                                let timeStlots = '';
                                for (index = 0; index <
                                intervals.length; ++index) {
                                    let data = [
                                        {
                                            'index': index,
                                            'timeSlot': intervals[index],
                                        }];
                                    var timeSlot = prepareTemplateRender(
                                        '#appointmentSlotTemplate', data);
                                    timeStlots += timeSlot;
                                }
                                $('.available-slot').append(timeStlots);
                            }

                            // display Day Name and time
                            if ((availableFrom !=
                                    '00:00:00' &&
                                    result.data.scheduleDay[0].available_to !=
                                    '00:00:00') &&
                                (doctorStartTime != doctorEndTime)) {
                                $('.doctor-schedule').
                                    css('display', 'block');
                                $('.color-information').
                                    css('display', 'block');
                                $('.day-name').html(
                                    result.data.scheduleDay[0].available_on);
                                $('.schedule-time').html('[' +
                                    availableFrom +
                                    ' - ' +
                                    result.data.scheduleDay[0].available_to +
                                    ']');
                            } else {
                                $('.doctor-schedule').css('display', 'none');
                                $('.color-information').css('display', 'none');
                                $('.error-message').css('display', 'block');
                                $('.error-message').html(
                                    'Doctor Schedule not available this date.');
                            }
                        } else {
                            $('.doctor-schedule').css('display', 'none');
                            $('.color-information').css('display', 'none');
                            $('.error-message').css('display', 'block');
                            $('.error-message').html(
                                'Doctor Schedule not available this date.');
                        }
                    }
                }
            },
        });
        /*
        if (isCreate || isEdit) {
            var delayCall = 200;
            setTimeout(getCreateTimeSlot, delayCall);

            function getCreateTimeSlot () {
                if (isCreate) {
                    var data = {
                        editSelectedDate: selectedDate,
                        doctor_id: doctorId,
                    };
                } else {
                    var data = {
                        editSelectedDate: selectedDate,
                        editId: appointmentEditId,
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
                                                            data('id') == i) {
                                                            if ($(this).
                                                                    html() !=
                                                                editTimeSlot) {
                                                                $(this).
                                                                    parent().
                                                                    css({
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
                                    $(this).parent().addClass('time-slot-book');
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
                                                    if ($(this).data('id') ==
                                                        i) {
                                                        $(this).
                                                            parent().
                                                            addClass(
                                                                'time-slot-book');
                                                        $('.time-slot-book').
                                                            css({
                                                                'background-color': '#ffa721',
                                                                'border': '1px solid #ffa721',
                                                                'color': '#ffffff',
                                                            });
                                                        $(this).
                                                            parent().
                                                            addClass('booked');
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
        
         */
    }

});
