'use strict';

$(document).ready(function () {
    $('#doctorId, #serialVisibilityId').select2({
        width: '100%',
    });

    $('#perPatientTime').flatpickr({
        enableTime: true,
        noCalendar: true,
        enableSeconds: true,
        dateFormat: 'H:i:S',
        time_24hr: true,
    });

    $('#doctorId').first().focus();
    $(document).on('click', '.copy-btn', function (e) {
        e.preventDefault();
        let Ele = checkedEle($(this).parent().parent());
        let id = $(e.currentTarget).data('id');
        let oldId = id - 1;
        let availableFrom = $('#availableFrom-'.concat(oldId)).val();
        let availableTo = $('#availableTo-'.concat(oldId)).val();
        availableFrom = Ele.find('td .availableFrom').val();
        availableTo = Ele.find('td .availableTo').val();
        let availableTimeFrom = '';
        let availableTimeTo = '';
        // if (hospitalStartTime[id + 1][0] > availableFrom) {
        //     displayErrorMessage(
        //         'Hospital Schedule doesn\'t match with Selected Time');
        //     availableTimeFrom = hospitalStartTime[id + 1][0];
        //     $('#availableFrom-'.concat(id)).
        //         val(hospitalStartTime[id + 1][0] + ':00');
        // } else {
        availableTimeFrom = availableFrom;
        $('#availableFrom-'.concat(id)).val(availableFrom);
        // }
        // if (hospitalStartTime[id + 1][1] > availableTo) {
        //     availableTimeTo = hospitalStartTime[id + 1][1];
        //     $('#availableTo-'.concat(id)).
        //         val(hospitalStartTime[id + 1][1] + ':00');
        // } else {
        availableTimeTo = availableTo;
        $('#availableTo-'.concat(id)).val(availableTo);
        // }
        let newId = id + 1;
        $('.hospitalScheduleFrom-' + newId).flatpickr({
            enableTime: true,
            noCalendar: true,
            enableSeconds: true,
            dateFormat: 'H:i:S',
            time_24hr: true,
            minTime: availableTimeFrom,
        });
        $('.hospitalScheduleTo-' + newId).flatpickr({
            enableTime: true,
            noCalendar: true,
            enableSeconds: true,
            dateFormat: 'H:i:S',
            time_24hr: true,
            maxTime: availableTimeTo,
        });
    });

    let hospitalDayOfWeek = [];
    let hospitalStartTime = [];
    $.each(hospitalSchedule, function (i, v) {
        hospitalDayOfWeek[i] = parseInt(v.day_of_week);
        hospitalStartTime[v.day_of_week] = [v.start_time, v.end_time];
    });

    function checkedEle (element) {
        if (element.prev().length > 0) {
            if (element.prev().css('display') == 'none') {
                return checkedEle(element.prev());
            } else {
                return element.prev();
            }
        }
    }

    let i = 0;
    let perPatTime = $('#perPatientTime').val();
    for (i; i <= 7; i++) {
        if ($.inArray(i, hospitalDayOfWeek) !== -1) {
            hospitalDayOfWeek.sort();
            $('.cpy-btn' + (hospitalDayOfWeek[0] - 1)).hide();
            let hospitalScheduleFrom = $('.hospitalScheduleFrom-' + i).
                flatpickr({
                    enableTime: true,
                    noCalendar: true,
                    enableSeconds: true,
                    dateFormat: 'H:i:S',
                    time_24hr: true,
                    minTime: hospitalStartTime[i][0],
                    maxTime: hospitalStartTime[i][1],
                    onChange: function (selectedDate, dateStr) {
                        hospitalToSchedule.clear();
                        hospitalToSchedule.set('minTime',
                            dateStr.split(':')[0] + ':' +
                            parseInt(dateStr.split(':')[1]) + 5);
                    },
                });
            let hospitalToScheduleMinTime = hospitalScheduleFrom.element.value !=
            '00:00:00'
                ? hospitalScheduleFrom.element.value
                : hospitalStartTime[i][0];
            let hospitalToSchedule = $('.hospitalScheduleTo-' + i).flatpickr({
                enableTime: true,
                noCalendar: true,
                enableSeconds: true,
                dateFormat: 'H:i:S',
                time_24hr: true,
                minTime: hospitalToScheduleMinTime.split(':')[0] + ':' +
                    parseInt(hospitalToScheduleMinTime.split(':')[1]) + 5,
                maxTime: hospitalStartTime[i][1],
            });
        } else {
            $('.hospitalScheduleFrom-' + i).parent().parent().hide();
        }
    }

    $('#createScheduleForm').on('submit', function () {
        let perPatientTime = $('#perPatientTime').val();

        if (perPatientTime == '00:00:00') {
            $('#validationErrorsBox').html('Please select per patient time').show();
            return false;
        }

        let j = 0;
        let availableFrom = true;
        for (j; j <= 6; j++) {
            if ($('#availableFrom-' + j).val() != '00:00:00') {
                availableFrom = false;
            }
        }
        if (availableFrom) {
            $('#validationErrorsBox').show().html('Available From time must be greater than Zero');
            $('#validationErrorsBox').delay(5000).fadeOut();
            return false;
        }

        let i = 0;
        let availableTo = true;
        for (i; i <= 6; i++) {
            if ($('#availableTo-' + i).val() != '00:00:00') {
                availableTo = false;
            }
        }
        if (availableTo) {
            $('#validationErrorsBox').show().html('Available To time must be greater than Zero');
            $('#validationErrorsBox').delay(5000).fadeOut();
            return false;
        }
    });
});
