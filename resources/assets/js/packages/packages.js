'use strict';

$(document).ready(function () {
    let tbl = $('#packagesReportTable').DataTable({
        processing: true,
        serverSide: true,
        'language': {
            'lengthMenu': 'Show _MENU_',
        },
        'order': [[4, 'desc']],
        ajax: {
            url: packageReportUrl,
        },
        columnDefs: [
            {
                'targets': [3],
                'orderable': false,
                'className': 'text-center text-nowrap',
                'width': '8%',
            },
            {
                'targets': [1, 2],
                'className': 'text-right',
                'width': '10%',
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
                    let showLink = packageReportUrl + '/' + row.id;
                    return '<a href="' + showLink + '">' + row.name + '</a>';
                },
                name: 'name',
            },
            {
                data: function (row) {
                    return row.discount + '%';
                },
                name: 'discount',
            },
            {
                data: function (row) {
                    return !isEmpty(row.total_amount) ? '<p class="cur-margin">' +
                        getCurrentCurrencyClass() + ' ' +
                        addCommas(row.total_amount) + '</p>' : 'N/A';
                },
                name: 'total_amount',
            },
            {
                data: function (row) {
                    let url = packageReportUrl + '/' + row.id;
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
    });
    handleSearchDatatable(tbl);
});

$(document).on('click', '.delete-btn', function (event) {
    let packageId = $(event.currentTarget).data('id');
    deleteItem(
        packageReportUrl + '/' + packageId,
        '#packagesReportTable',
        'Package',
    );
});
