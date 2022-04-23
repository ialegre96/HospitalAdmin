'use strict';

$(document).ready(function () {
    let tableName = $('#subscriptionPlanTable');
    let tbl = tableName.DataTable({
        processing: true,
        serverSide: true,
        searchDelay: 500,
        'language': {
            'lengthMenu': 'Show _MENU_',
        },
        'order': [[1, 'desc']],
        ajax: {
            url: subscriptionPlanUrl,
            data: function (data) {
                data.plan_type = $('#planTypeFilter').
                    find('option:selected').
                    val();
            },
        },
        columnDefs: [
            {
                'targets': [4],
                'orderable': false,
                'className': 'text-center',
            },
            {
                'targets': [5, 6],
                'width': '13%',
                'orderable': false,
                'className': 'text-center',
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
                    return !isEmpty(row.price) ? '<p class="mb-0">' +
                        row.plan_currency_symbol + ' ' + addCommas(row.price) +
                        '</p>' : 'N/A';
                },
                name: 'price',
            },
            {
                data: function (row) {
                    if (row.frequency == 1)
                        return 'Month';
                    else
                        return 'Year';
                },
                name: 'created_at',
            },
            {
                data: function (row) {
                    if (row.trial_days != 0)
                        return row.trial_days + ' ' + 'Days';
                    else
                        return 'N/A';
                },
                name: 'trial_days',
            },
            {
                data: function (row) {
                    return `<span class="badge badge-light-info fs-7">${row.subscription.length}</span>`;
                },
                name: 'id',
            },
            {
                data: function (row) {
                    let checked = row.is_default == 1 ? 'checked' : '';
                    let data = [{ 'id': row.id, 'checked': checked }];
                    return prepareTemplateRender(
                        '#makeDefaultSubscriptionPlanTemplate',
                        data);
                },
                name: 'is_default',
            },
            {
                data: function (row) {
                    let url = subscriptionPlanUrl + '/' + row.id + '/edit';
                    let data = [
                        {
                            'id': row.id,
                            'url': url,
                            'is_trail_plan': row.is_trail_plan,
                            'showUrl': subscriptionPlanUrl + '/' + row.id,
                            'isDefault': row.is_default != 1 ? true : false,
                        }];
                    return prepareTemplateRender('#subscriptionPlanTemplate',
                        data);
                }, name: 'id',
            },
        ],
        'fnInitComplete': function () {
            $(document).on('change', '#planTypeFilter', function () {
                $(tableName).DataTable().ajax.reload(null, true);
            });
        },
    });
    handleSearchDatatable(tbl);

    $(document).on('click', '#resetFilter', function () {
        $('#planTypeFilter').val('').trigger('change');
    });

    $(document).on('click', '.delete-btn', function (e) {
        let subscriptionId = $(this).data('id');
        let deleteSubscriptionUrl = subscriptionPlanUrl + '/' +
            subscriptionId;
        deleteItem(deleteSubscriptionUrl, '#subscriptionPlanTable',
            'Subscription Plan');
    });

    $(document).on('change', '.is_default', function (event) {
        let subscriptionPlanId = $(event.currentTarget).data('id');
        updateStatusToDefault(subscriptionPlanId);
    });

    window.updateStatusToDefault = function (id) {
        $.ajax({
            url: subscriptionPlanUrl + '/' + id + '/make-plan-as-default',
            method: 'post',
            cache: false,
            success: function (result) {
                if (result.success) {
                    displaySuccessMessage(result.message);
                    $(tableName).DataTable().ajax.reload(null, false);
                }
            },
        });
    };
});
