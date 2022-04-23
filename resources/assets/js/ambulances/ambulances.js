'use strict';

$(document).ready(function () {
    let tableName = '#ambulancesTbl';
    let tbl = $('#ambulancesTbl').DataTable({
        processing: true,
        serverSide: true,
        searchDelay: 500,
        'language': {
            'lengthMenu': 'Show _MENU_',
        },
        'order': [[9, 'desc']],
        ajax: {
            url: ambulanceUrl,
            data: function (data) {
                data.is_available = $('#filter_status').
                    find('option:selected').
                    val();
            },
        },
        columnDefs: [
            {
                'targets': [6],
                'className': 'text-center',
                'width': '10%',
            },
            {
                'targets': [7],
                'orderable': false,
                'width': '10%',
            },
            {
                'targets': [8],
                'orderable': false,
                'className': 'text-center text-nowrap',
                'width': '15%',
            },
            {
                'targets': [9],
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
                data: 'vehicle_number',
                name: 'vehicle_number',
            },
            {
                data: 'vehicle_model',
                name: 'vehicle_model',
            },
            {
                data: 'year_made',
                name: 'year_made',
            },
            {
                data: 'driver_name',
                name: 'driver_name',
            },
            {
                data: 'driver_license',
                name: 'driver_license',
            },
            {
                data: 'driver_contact',
                name: 'driver_contact',
            },
            {
                data: function (row) {
                    if (row.vehicle_type == 1) {
                        return 'Owned';
                    } else {
                        return 'Contractual';
                    }
                },
                name: 'vehicle_type',
            },
            {
                data: function (row) {
                    let checked = row.is_available == 0 ? '' : 'checked';
                    let data = [{ 'id': row.id, 'checked': checked }];
                    return prepareTemplateRender('#ambulanceIsAvailableTemplate',
                        data);
                },
                name: 'is_available',
            },
            {
                data: function (row) {
                    let url = ambulanceUrl + '/' + row.id;
                    let data = [
                        {
                            'id': row.id,
                            'url': url + '/edit',
                            'viewUrl': url,
                        }];
                    return prepareTemplateRender('#ambulanceActionTemplate',
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
    let ambulanceId = $(event.currentTarget).data('id');
    deleteItem(ambulanceUrl + '/' + ambulanceId, '#ambulancesTbl', 'Ambulance');
});
$(document).on('change', '.status', function (event) {
    let ambulanceId = $(event.currentTarget).data('id');
    updateIsAvailable(ambulanceId);
});
$(document).on('click', '#resetFilter', function () {
    $('#filter_status').val(2).trigger('change');
});
window.updateIsAvailable = function (id) {
    $.ajax({
        url: ambulanceUrl + '/' + id + '/active-deactive',
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
