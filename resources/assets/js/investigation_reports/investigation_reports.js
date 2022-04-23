'use strict';

$(document).ready(function () {
    let tableName = '#investigationReportTable';
    let tbl = $('#investigationReportTable').DataTable({
        processing: true,
        serverSide: true,
        searchDelay: 500,
        'language': {
            'lengthMenu': 'Show _MENU_',
        },
        'order': [8, 'desc'],
        ajax: {
            url: investigationReportUrl,
            data: function (data) {
                data.status = $('#filter_status').find('option:selected').val();
            },
        },
        columnDefs: [
            {
                'targets': [4],
                'sortable': false,
                'className': 'text-center',
            },
            {
                'targets': [5],
                'orderable': false,
                'className': 'text-center text-nowrap',
                'width': '8%',
            },
            {
                'targets': [6, 7],
                'visible': false,
            },
            {
                'targets': [8],
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
                    return `<div class="d-flex align-items-center">
                            <div class="symbol symbol-circle symbol-50px overflow-hidden me-3">
                                <a href="${showLink}">
                                    <div class="">
                                        <img src="${row.image_url}" alt="" class="user-img">
                                    </div>
                                </a>
                           </div>
                           <div class="d-flex flex-column">
                                <a href="${showLink}" class="mb-1">${row.patient.user.full_name}</a>
                                <span>${row.patient.user.email}</span>
                            </div>
                         </div>`;
                },
                name: 'patient.user.first_name',
            },
            {
                data: function (row) {
                    return row;
                },
                render: function (row) {
                    if (row.date === null) {
                        return 'N/A';
                    }

                    return `<div class="badge badge-light">
                                <div class="mb-2">${moment(row.date).
                        utc().
                        format('LT')}</div>
                                <div>${moment(row.date).format('Do MMM, Y')}</div>
                            </div>`;
                },
                name: 'date',
            },
            {
                data: 'title',
                name: 'title',
            },
            {
                data: function (row) {
                    if (row.status == 1)
                        return 'Solved';
                    else
                        return 'Not Solved';
                },
                name: 'status',
            },
            {
                data: function (row) {
                    if (row.attachment_url != null) {
                        let downloadLink = downloadDocumentUrl + '/' + row.id;
                        return '<a href="' + downloadLink + '">' + 'Download' +
                            '</a>';
                    } else {
                        return 'N/A';
                    }
                },
                name: 'id',
            },
            {
                data: function (row) {
                    let url = investigationReportUrl + '/' + row.id;
                    let data = [
                        {
                            'id': row.id,
                            'url': url + '/edit',
                        }];
                    return prepareTemplateRender(
                        '.pageActionTemplate', data);
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
            {
                data: 'created_at',
                name: 'created_at',
            },
        ],
        'fnInitComplete': function () {
            $(document).on('change', '#filter_status', function () {
                $(tableName).DataTable().ajax.reload(null, true);
            });
        },
    });
    handleSearchDatatable(tbl);
});

$(document).on('click', '#resetFilter', function () {
    $('#filter_status').val(2).trigger('change');
});

$(document).on('click', '.delete-btn', function (event) {
    let investigationReportId = $(event.currentTarget).data('id');
    deleteItem(
        investigationReportUrl + '/' + investigationReportId,
        '#investigationReportTable',
        'Investigation Report',
    );
});
