'use strict';

let tableName = '#schedulesTbl';
$(document).ready(function () {

    let tbl = $('#schedulesTbl').DataTable({
        searchDelay: 500,
        processing: true,
        serverSide: true,
        'language': {
            'lengthMenu': 'Show _MENU_',
        },
        'order': [[3, 'desc']],
        ajax: {
            url: scheduleUrl,
        },
        columnDefs: [
            {
                'targets': [2],
                'orderable': false,
                'className': 'text-center text-nowrap',
                'width': '15%',
            },
            {
                'targets': [3],
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
                    let showLink = doctorUrl + '/' + row.doctor.id;
                    return `<div class="d-flex align-items-center">
                        <div class="symbol symbol-circle symbol-50px overflow-hidden me-3">
                        <a href="${showLink}">
                            <div>
                                <img src="${row.image_url}" alt=""
                                     class="user-img">
                            </div>
                        </a>
                        </div>
                        <div class="d-flex flex-column">
                            <a href="${showLink}"
                               class="mb-1">${row.doctor.user.full_name}</a>
                            <span>${row.doctor.user.email}</span>
                        </div>
                    </div>`;
                },
                name: 'doctor.user.first_name',
            },
            {
                data: function (row) {
                    return row;
                },
                render: function (row) {
                    let time = moment(row.per_patient_time, 'HH:mm:ss').format('HH:mm');
                    if (time > moment('00:59:00', 'HH:mm:ss').format('HH:mm')) {
                        return time + ' hours';
                    }
                    return moment(row.per_patient_time, 'HH:mm:ss').format('m') +
                        ' minutes';
                },
                name: 'per_patient_time',
            },
            {
                data: function (row) {
                    let url = scheduleUrl + '/' + row.id;
                    let data = [
                        {
                            'id': row.id,
                            'url': url + '/edit',
                            'viewUrl': url,
                        }];
                    return prepareTemplateRender('#scheduleActionTemplate',
                        data);
                }, name: 'doctor.user.last_name',
            },
            {
                data: 'created_at',
                name: 'created_at',
            },
        ],
    });
    handleSearchDatatable(tbl);
});

$(document).on('click', '.delete-btn', function (event) {
    let scheduleId = $(event.currentTarget).data('id');
    deleteItem(scheduleUrl + '/' + scheduleId, '#schedulesTbl', 'Schedule');
});
