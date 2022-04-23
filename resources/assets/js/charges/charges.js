'use strict';

$(document).ready(function () {
    let tbl = $('#chargesTbl').DataTable({
        processing: true,
        serverSide: true,
        searchDelay: 500,
        'language': {
            'lengthMenu': 'Show _MENU_',
        },
        'order': [[5, 'desc']],
        ajax: {
            url: chargeUrl,
            data: function (data) {
                data.charge_type = $('#filterChargeType').
                    find('option:selected').
                    val();
            },
        },
        columnDefs: [
            {
                'targets': [3],
                'className': 'text-right',
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
                data: 'code',
                name: 'code',
            },
            {
                data: function (row) {
                    let showLink = chargeCategoryUrl + '/' + row.charge_category.id;
                    return '<a href="' + showLink + '">' +
                        row.charge_category.name + '</a>';
                },
                name: 'chargeCategory.name',
            },
            {
                data: function (row) {
                    if (row.charge_type == 1) {
                        return 'Procedures';
                    } else if (row.charge_type == 2) {
                        return 'Investigations';
                    } else if (row.charge_type == 3) {
                        return 'Supplier';
                    } else if (row.charge_type == 4) {
                        return 'Operation Theatre';
                    } else {
                        return 'Others';
                    }

                }, name: 'charge_type',
            },
            {
                data: function (row) {
                    return !isEmpty(row.standard_charge) ? '<p class="cur-margin">' +
                        getCurrentCurrencyClass() + ' ' +
                        addCommas(row.standard_charge) + '</p>' : 'N/A';
                },
                name: 'standard_charge',
            },
            {
                data: function (row) {
                    let data = [
                        {
                            'id': row.id,
                        }];
                    return prepareTemplateRender('#chargeActionTemplate',
                        data);
                }, name: 'id',
            },
            {
                data: 'created_at',
                name: 'created_at',
            },
        ],
        'fnInitComplete': function () {
            $(document).on('change', '#filterChargeType', function () {
                $('#chargesTbl').DataTable().ajax.reload(null, true);
            });
        },
    });
    handleSearchDatatable(tbl);
});

$(document).on('click', '#resetFilter', function () {
    $('#filterChargeType').val(0).trigger('change');
});

$(document).on('click', '.delete-btn', function (event) {
    let chargeId = $(event.currentTarget).data('id');
    deleteItem(chargeUrl + '/' + chargeId,
        '#chargesTbl',
        'Charge');
});
