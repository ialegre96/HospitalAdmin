'use strict';

$(document).ready(function () {
    let tableName = '#bedsTbl';
    let tbl = $('#bedsTbl').DataTable({
        processing: true,
        serverSide: true,
        searchDelay: 500,
        'language': {
            'lengthMenu': 'Show _MENU_',
        },
        'order': [6, 'desc'],
        ajax: {
            url: bedUrl,
            data: function (data) {
                data.status = $('#filter_status').find('option:selected').val();
            },
        },
        columnDefs: [
            {
                'targets': [0],
                'width': '10%',
            },
            {
                'targets': [3],
                'width': '10%',
                'className': 'text-right',
            },
            {
                'targets': [4],
                'className': 'text-center',
                'width': '8%',
            },
            {
                'targets': [5],
                'orderable': false,
                'className': 'text-center text-nowrap',
                'width': '8%',
            },
            {
                'targets': [6],
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
                    let showLink = bedUrl + '/' + row.id;
                    return '<a href="' + showLink + '" class="badge badge-light-info">' + row.bed_id + '</a>';
                },
                name: 'bed_id',
            },
            {
                data: 'name',
                name: 'name',
            },
            {
                data: function (row) {
                    let showLink = bedTypesUrl + '/' + row.bed_type.id;
                    return '<a href="' + showLink + '">' + row.bed_type.title +
                        '</a>';
                },
                name: 'bedType.title',
            },
            {
                data: function (row) {
                    return !isEmpty(row.charge) ? '<p class="cur-margin">' +
                        getCurrentCurrencyClass() + ' ' +
                        addCommas(row.charge) + '</p>' : 'N/A';
                },
                name: 'charge',
            },
            {
                data: function (row) {
                    if (row.is_available) {
                        return `<span class="badge badge-light-success">Yes</span>`;
                    }
                    return `<span class="badge badge-light-danger">No</span>`;
                },
                name: 'is_available',
            },
            {
                data: function (row) {
                    let data = [
                        {
                            'id': row.id,
                        }];
                    return prepareTemplateRender('.modalActionTemplate', data);
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
});

$(document).on('click', '.delete-btn', function (event) {
    let bedId = $(event.currentTarget).data('id');
    deleteItem(bedUrl + '/' + bedId, '#bedsTbl', 'Bed');
});

// status activation deactivation change event
$(document).on('change', '.status', function (event) {
    let bedId = $(event.currentTarget).data('id');
    activeDeActiveStatus(bedId);
});

$(document).on('click', '#resetFilter', function () {
    $('#filter_status').val(2).trigger('change');
});

// activate de-activate Status
window.activeDeActiveStatus = function (id) {
    $.ajax({
        url: bedUrl + '/' + id + '/active-deactive',
        method: 'post',
        cache: false,
        success: function (result) {
            if (result.success) {
                tbl.ajax.reload(null, false);
            }
        },
    });
};
