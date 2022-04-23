'use strict';

$(document).ready(function () {
    let tableName = '#subscriptionTable';
    let tbl = $(tableName).DataTable({
        searchDelay: 500,
        processing: true,
        serverSide: true,
        'language': {
            'lengthMenu': 'Show _MENU_',
        },
        'order': [[3, 'desc']],
        ajax: {
            url: hospitalUrl,
            data: function (data) {
                data.status = $('#statusArr')
                    .find('option:selected')
                    .val();
                data.plan_frequency = $('#frequencyArr')
                    .find('option:selected')
                    .val();
            },
        },
        columnDefs: [
            {
                'targets': [0],
                'orderable': true,
                'searchable': true,

            },
            {
                'targets': [1, 2, 3, 4, 5],
                'orderable': true,
                'searchable': true,
            },
            {
                'targets': [4],
                'className': 'text-center align-middle text-nowrap',
                'orderable': true,
                'searchable': true,
            },
            {
                'targets': [6, 7],
                'orderable': false,
                'searchable': false,
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
                    return row.user.full_name;
                },
                name: 'user.first_name',
            },
            {
                data: function (row) {
                    return row.subscription_plan.name;
                },
                name: 'subscription_plan.name',
            },
            {
                data: function (row) {
                    return '<p class="mb-0">' + row.plan_currency_symbol + ' ' +
                        addCommas(row.plan_amount) + '</p>';
                },
                name: 'plan_amount',
            },
            {
                data: function (row) {
                    return `<div class="badge badge-light">
                                <div class="mb-2">${moment(row.starts_at)
                        .format('LT')}</div>
                                <div>${moment(row.starts_at)
                        .format('Do MMM, Y')}</div>
                            </div>`;
                },
                name: 'starts_at',
            },
            {
                data: function (row) {
                    return `<div class="badge badge-light">
                                <div class="mb-2">${moment(row.ends_at)
                        .format('LT')}</div>
                                <div>${moment(row.ends_at)
                        .format('Do MMM, Y')}</div>
                            </div>`;
                },
                name: 'ends_at',
            },
            {
                data: function (row) {
                    if (row.plan_frequency == 1) {
                        return `<span class="badge badge-light-success">${month}</span>`;
                    } else if (row.plan_frequency == 2) {
                        return `<span class="badge badge-light-danger">${year}</span>`;
                    }
                },
                name: 'plan_frequency',
            },
            {
                data: function (row) {
                    if (row.status == 1) {
                        return `<span class="badge badge-light-success">${active}<span>`;
                    } else if (row.status == 0) {
                        return `<span class="badge badge-light-danger">${inactive}</span>`;
                    }
                },
                name: 'status',
            },
            {
                data: function (row) {
                    let data = [
                        {
                            'id': row.id,
                            'showUrl': route('subscriptions.list.show', row.id),
                            'editUrl': route('subscriptions.list.edit', row.id)
                        },
                    ];
                    return prepareTemplateRender('#subscriptionTemplate',
                        data);
                }, name: 'id',
            },

        ],
        'fnInitComplete': function () {
            $(document).on('change', '#statusArr, #frequencyArr', function () {
                $(tableName).DataTable().ajax.reload(null, true);
            });
        },
    });

    handleSearchDatatable(tbl);
});

$(document).on('click', '#resetFilter', function () {
    $('#paymentTypeArr, #statusArr, #frequencyArr').val('').trigger('change');
});
