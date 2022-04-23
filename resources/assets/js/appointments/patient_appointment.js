'use strict';

let tbl = $('#appointmentsTbl').DataTable({
    searchDelay: 500,
    processing: true,
    serverSide: true,
    'language': {
        'lengthMenu': 'Show _MENU_',
    },
    'order': [[3, 'desc']],
    ajax: {
        url: appointmentUrl,
        data: function (data) {
            data.start_date = startTime;
            data.end_date = endTime;
            data.is_completed = $('#status').find('option:selected').val();
        },
    },
    columnDefs: [
        {
            'targets': [3],
            'width': '18%',
        },
        {
            'targets': [4],
            'orderable': false,
            'className': 'text-center text-nowrap',
            'width': '12%',
        },
        {
            'targets': [5, 6],
            'visible': false,
        },
        {
            targets: '_all',
            defaultContent: 'N/A',
            'className': 'text-start align-middle text-nowrap',
        },
    ],
    columns: [
        {
            data: function (row) {
                let showLink = patientUrl + '/' + row.patient.id;
                return `<div class="symbol symbol-circle symbol-50px overflow-hidden me-3">
                        <a href="${showLink}">
                            <div>
                                <img src="${row.patientImageUrl}" alt=""
                                    class="user-img">
                            </div>
                        </a>
                    </div>
                    <div class="d-inline-block align-top">
                        <a href="${showLink}"
                           class="text-primary-800 mb-1 d-block">${row.patient.user.full_name}</a>
                        <span class="d-block">${row.patient.user.email}</span>
                    </div>`;
            },
            name: 'patient.user.first_name',
        },
        {
            data: function (row) {
                if (patientRole) {
                    return `<div class="symbol symbol-circle symbol-50px overflow-hidden me-3">
                        <a>
                            <div>
                                <img src="${row.doctorImageUrl}" alt="" class="user-img">
                            </div>
                        </a>
                    </div>
                    <div class="d-inline-block align-top">
                        <a class="text-dark fw-bold mb-1 d-block">${row.doctor.user.full_name}</a>
                        <span class="d-block">${row.doctor.user.email}</span>
                    </div>`;
                }
                let showLink = doctorUrl + '/' + row.doctor.id;
                return `<div class="symbol symbol-circle symbol-50px overflow-hidden me-3">
                        <a>
                            <div>
                                <img src="${row.doctorImageUrl}" alt="" class="user-img">
                            </div>
                        </a>
                    </div>
                    <div class="d-inline-block align-top">
                        <a href="${showLink}" class="fw-bold mb-1 d-block">${row.doctor.user.full_name}</a>
                        <span class="d-block">${row.doctor.user.email}</span>
                    </div>`;
            },
            name: 'doctor.user.first_name',
        },
        {
            data: function (row) {
                let showLink = doctorDepartmentUrl + '/' +
                    row.doctor.department.id;
                return '<a href="' + showLink + '">' +
                    row.doctor.department.title + '</a>';
            },
            name: 'doctor.department.title',
        },
        {
            data: function (row) {
                return row;
            },
            render: function (row) {
                if (row.opd_date === null) {
                    return 'N/A';
                }
                
                return `<div class="badge badge-light">
                                <div class="mb-2">${moment(row.opd_date).utc().format('LT')}</div>
                                <div>${moment(row.opd_date).utc().format('Do MMM, Y')}</div>
                            </div>`;
            },
            name: 'opd_date',
        },
        {
            data: function (row) {
                let url = appointmentUrl + '/' + row.id;
                let data = [
                    {
                        'id': row.id,
                        'url': url + '/edit',
                        'viewUrl': url,
                        'isDoctor': doctorRole,
                    }];
                return prepareTemplateRender('#appointmentActionTemplate',
                    data);
            }, name: 'id',
        },
        {
            data: 'patient.user.last_name',
            name: 'patient.user.last_name',
        },
        {
            data: 'doctor.user.last_name',
            name: 'doctor.user.last_name',
        },
    ],
    'fnInitComplete': function () {
        $(document).on('change', '#status', function () {
            $('#appointmentsTbl').DataTable().ajax.reload(null, true);
        });
    },
});
handleSearchDatatable(tbl);

$(document).on('click', '.delete-btn', function (event) {
    let appointmentId = $(event.currentTarget).data('id');
    deleteItem(appointmentUrl + '/' + appointmentId, '#appointmentsTbl',
        'Appointment');
});

$(document).on('click', '#resetFilter', function () {
    timeRange.data('daterangepicker').
        setStartDate(moment().startOf('week').format('MM/DD/YYYY'));
    timeRange.data('daterangepicker').
        setEndDate(moment().endOf('week').format('MM/DD/YYYY'));
    startTime = timeRange.data('daterangepicker').
        startDate.
        format('YYYY-MM-D  H:mm:ss');
    endTime = timeRange.data('daterangepicker').
        endDate.
        format('YYYY-MM-D  H:mm:ss');
    $('#status').val(2).trigger('change');
});

$('#status').select2();

let timeRange = $('#time_range');
var start = moment().subtract(29, 'days');
var end = moment();
let startTime = '';
let endTime = '';

function cb (start, end) {
    $('#time_range').
        html(start.format('MMM D, YYYY') + ' - ' + end.format('MMM D, YYYY'));
}

timeRange.daterangepicker({
    startDate: start,
    endDate: end,
    ranges: {
        'Today': [moment(), moment()],
        'Yesterday': [
            moment().subtract(1, 'days'),
            moment().subtract(1, 'days')],
        'Last 7 Days': [moment().subtract(6, 'days'), moment()],
        'Last 30 Days': [moment().subtract(29, 'days'), moment()],
        'This Month': [moment().startOf('month'), moment().endOf('month')],
        'Last Month': [
            moment().subtract(1, 'month').startOf('month'),
            moment().subtract(1, 'month').endOf('month')],
    },
}, cb);

cb(start, end);
timeRange.on('apply.daterangepicker', function (ev, picker) {
    startTime = picker.startDate.format('YYYY-MM-D  H:mm:ss');
    endTime = picker.endDate.format('YYYY-MM-D  H:mm:ss');
    $('#appointmentsTbl').DataTable().ajax.reload(null, true);
});
