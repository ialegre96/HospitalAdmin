'use strict';

$(document).ready(function () {
    let tableName = '#insurancesTbl';
    let tbl = $('#insurancesTbl').DataTable({
        processing: true,
        serverSide: true,
        searchDelay: 500,
        'language': {
            'lengthMenu': 'Show _MENU_',
        },
        'order': [[8, 'desc']],
        ajax: {
            url: insuranceUrl,
            data: function (data) {
                data.status = $('#filter_status').find('option:selected').val();
            },

        },
        columnDefs: [
            {
                'targets': [1, 4, 5],
                'className': 'text-right',
            },
            {
                'targets': [6],
                'orderable': false,
                'width': '5%',
            },
            {
                'targets': [7],
                'orderable': false,
                'className': 'text-center text-nowrap',
                'width': '8%',
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
                    let showLink = insuranceUrl + '/' + row.id;
                    return '<a href="' + showLink + '">' + row.name + '</a>';
                },
                name: 'name',
            },
            {
                data: function (row) {
                    return !isEmpty(row.service_tax) ? '<p class="cur-margin">' +
                        getCurrentCurrencyClass() + ' ' +
                        addCommas(row.service_tax) + '</p>' : 'N/A';
                },
                name: 'service_tax',
            },
            {
                data: 'insurance_no',
                name: 'insurance_no',
            },
            {
                data: 'insurance_code',
                name: 'insurance_code',
            },
            {
                data: function (row) {
                    return !isEmpty(row.hospital_rate) ? '<p class="cur-margin">' +
                        getCurrentCurrencyClass() + ' ' +
                        addCommas(row.hospital_rate) + '</p>' : 'N/A';
                },
                name: 'hospital_rate',
            },
            {
                data: function (row) {
                    return !isEmpty(row.total) ? '<p class="cur-margin">' +
                        getCurrentCurrencyClass() + ' ' +
                        addCommas(row.total) + '</p>' : 'N/A';
                },
                name: 'total',
            },
            {
                data: function (row) {
                    let checked = row.status == 0 ? '' : 'checked';
                    let data = [{ 'id': row.id, 'checked': checked }];
                    return prepareTemplateRender('#insuranceStatusTemplate', data);
                },
                name: 'status',
            },
            {
                data: function (row) {
                    let url = insuranceUrl + '/' + row.id;
                    let data = [
                        {
                            'id': row.id,
                            'url': url + '/edit',
                        }];
                    return prepareTemplateRender('.pageActionTemplate', data);
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
    let insuranceId = $(event.currentTarget).data('id');
    deleteItem(insuranceUrl + '/' + insuranceId, '#insurancesTbl', 'Insurance');
});

$(document).on('change', '.status', function (event) {
    let insuranceId = $(event.currentTarget).data('id');
    updateStatus(insuranceId);
});
$(document).on('click', '#resetFilter', function () {
    $('#filter_status').val(2).trigger('change');
});
window.updateStatus = function (id) {
    $.ajax({
        url: insuranceUrl + '/' + id + '/active-deactive',
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
