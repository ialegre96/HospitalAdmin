'use strict';

$(document).ready(function () {

    let tableName = '#bedAssignsTbl';
    let tbl = $('#bedAssignsTbl').DataTable({
        processing: true,
        serverSide: true,
        searchDelay: 500,
        'language': {
            'lengthMenu': 'Show _MENU_',
        },
        'order': [7, 'desc'],
        ajax: {
            url: bedAssignUrl,
            data: function (data) {
                data.status = $('#filter_status').
                    find('option:selected').
                    val();
            },
        },
        columnDefs: [
            {
                'targets': [2],
                'width': '10%',
            },
            {
                'targets': [5],
                'orderable': false,
                'width': '8%',
            },
            {
                'targets': [6],
                'orderable': false,
                'className': 'text-center text-nowrap',
                'width': '15%',
            },
            {
                'targets': [7],
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
                    let showLink = caseUrl + '/' + row.case_from_bed_assign.id;
                    return '<a href="' + showLink + '" class="badge badge-light-info">' + row.case_id + '</a>';
                },
                name: 'case_id',
            },
            {
                data: function (row) {
                    let showLink = patientUrl + '/' + row.patient.id;
                    return `<div class="symbol symbol-circle symbol-50px overflow-hidden me-3">
                        <a href="${showLink}">
                            <div>
                                <img src="${row.image_url}" alt="Emma Smith"
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
                    let showLink = bedUrl + '/' + row.bed.id;
                    return '<a href="' + showLink + '">' + row.bed.name +
                        '</a>';
                },
                name: 'bed.name',
            },
            {
                data: function (row) {
                    return row;
                },
                render: function (row) {
                    if (row.assign_date === null) {
                        return 'N/A';
                    }

                    return `<div class="badge badge-light">
                                <div>${moment(row.assign_date).format('Do MMM, Y')}</div>
                            </div>`;
                },
                name: 'assign_date',
            },
            {
                data: function (row) {
                    if (row.discharge_date === null) {
                        return 'N/A';
                    }

                    return moment(row.discharge_date).
                        format('Do MMM, Y h:mm A');
                },
                name: 'discharge_date',
            },
            {
                data: function (row) {
                    let checked = row.status == 0 ? '' : 'checked';
                    let data = [{ 'id': row.id, 'checked': checked }];
                    return prepareTemplateRender('#bedAssignStatusTemplate',
                        data);
                },
                name: 'status',
            },
            {
                data: function (row) {
                    let url = bedAssignUrl + '/' + row.id;
                    let data = [
                        {
                            'id': row.id,
                            'url': url + '/edit',
                            'viewUrl': url,
                        }];
                    return prepareTemplateRender('#bedAssignActionTemplate',
                        data);
                }, name: 'patient.user.last_name',
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


$(document).on('click', '.delete-btn', function (event) {
    let bedAssignId = $(event.currentTarget).data('id');
    deleteItem(bedAssignUrl + '/' + bedAssignId, '#bedAssignsTbl', 'Bed Assign');
});

$(document).on('change', '.status', function (event) {
    let bedAssignId = $(event.currentTarget).data('id');
    updateStatus(bedAssignId);
});

$(document).on('click', '#resetFilter', function () {
    $('#filter_status').val(2).trigger('change');
});

window.updateStatus = function (id) {
    $.ajax({
        url: bedAssignUrl + '/' + +id + '/active-deactive',
        method: 'post',
        cache: false,
        success: function (result) {
            if (result.success) {
                displaySuccessMessage(result.message);
                tbl.ajax.reload(null, false);
            }
        },
    });
};
});
