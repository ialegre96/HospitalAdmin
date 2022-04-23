'use strict';

let tableName = '#labTechniciansTable';
let tbl = $('#labTechniciansTable').DataTable({
    processing: true,
    serverSide: true,
    searchDelay: 500,
    'language': {
        'lengthMenu': 'Show _MENU_',
    },
    'order': [[4, 'desc']],
    ajax: {
        url: labTechnicianUrl,
        data: function (data) {
            data.status = $('#filter_status').find('option:selected').val();
        },
    },
    columnDefs: [
        {
            'targets': [2],
            'width': '5%',
            'orderable': false,
        },
        {
            'targets': [3],
            'className': 'text-center text-nowrap',
            'width': '8%',
            'orderable': false,
        },
        {
            'targets': [4],
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
                let showLink = labTechnicianUrl + '/' + row.id;
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
                                <a href="${showLink}" class="mb-1">${row.user.full_name}</a>
                                <span>${row.user.email}</span>
                            </div>
                    </div>`;
            },
            name: 'user.first_name',
        },
        {
            data: 'user.designation',
            name: 'user.designation',
        },
        {
            data: function (row) {
                let checked = row.user.status == 0 ? '' : 'checked';
                let data = [{ 'id': row.id, 'checked': checked }];
                return prepareTemplateRender('#labTechnicianStatusTemplate',
                    data);
            },
            name: 'user.status',
        },
        {
            data: function (row) {
                let url = labTechnicianUrl + '/' + row.id;
                let data = [
                    {
                        'id': row.id,
                        'url': url + '/edit',
                    }];
                return prepareTemplateRender('#labTechnicianActionTemplate',
                    data);
            }, name: 'id',
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
    let labTechnicianId = $(event.currentTarget).data('id');
    deleteItem(labTechnicianUrl + '/' + labTechnicianId, '#labTechniciansTable',
        'Lab Technician');
});

$(document).on('click', '#resetFilter', function () {
    $('#filter_status').val(2).trigger('change');
});

$(document).on('change', '.status', function (event) {
    let labTechnicianId = $(event.currentTarget).data('id');
    updateStatus(labTechnicianId);
});

$(document).on('click', '#resetFilter', function () {
    $('#filter_status').val('2').trigger('change');
});

window.updateStatus = function (id) {
    $.ajax({
        url: labTechnicianUrl + '/' + +id + '/active-deactive',
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
