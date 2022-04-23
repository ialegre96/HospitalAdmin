'use strict';

$(document).ready(function () {
    let tableName = '#servicesReportTable';
    let tbl = $('#servicesReportTable').DataTable({
        processing: true,
        serverSide: true,
        searchDelay: 500,
        'language': {
            'lengthMenu': 'Show _MENU_',
        },
        'order': [[5, 'desc']],
        ajax: {
            url: serviceReportUrl,
            data: function (data) {
                data.status = $('#filter_status').find('option:selected').val();
            },
        },
        columnDefs: [
            {
                'targets': [1, 2],
                'className': 'text-right',
                'width': '8%',
            },
            {
                'targets': [3],
                'width': '8%',
                'orderable': false,
            },
            {
                'targets': [4],
                'orderable': false,
                'className': 'text-center text-nowrap',
                'width': '8%',
            },
            {
                'targets': [5],
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
                data: 'name',
                name: 'name',
            },
            {
                data: function (row) {
                    return `<span class="badge badge-light-info fs-7">${row.quantity}</span>`;
                },
                name: 'quantity',
            },
            {
                data: function (row) {
                    return !isEmpty(row.rate) ? '<p class="cur-margin">' +
                        getCurrentCurrencyClass() + ' ' +
                        addCommas(row.rate) + '</p>' : 'N/A';
                },
                name: 'rate',
            },
            {
                data: function (row) {
                    let checked = row.status == 0 ? '' : 'checked';
                    let data = [{ 'id': row.id, 'checked': checked }];
                    return prepareTemplateRender('#servicesStatusTemplate', data);
                },
                name: 'status',
            },
            {
                data: function (row) {
                    let url = serviceReportUrl + '/' + row.id;
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
    let serviceId = $(event.currentTarget).data('id');
    deleteItem(
        serviceReportUrl + '/' + serviceId,
        '#servicesReportTable',
        'Service',
    );
});

$(document).on('change', '.status', function (event) {
    let serviceId = $(event.currentTarget).data('id');
    updateStatus(serviceId);
});
$(document).on('click', '#resetFilter', function () {
    $('#filter_status').val(2).trigger('change');
});
window.updateStatus = function (id) {
    $.ajax({
        url: serviceReportUrl + '/' + id + '/active-deactive',
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
