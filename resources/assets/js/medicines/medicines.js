'use strict';

$(document).ready(function () {
    let tableName = '#tblMedicines';
    let tbl = $('#tblMedicines').DataTable({
        processing: true,
        serverSide: true,
        searchDelay: 500,
        'language': {
            'lengthMenu': 'Show _MENU_',
        },
        'order': [[5, 'desc']],
        ajax: {
            url: medicineUrl,
        },
        columnDefs: [
            {
                'targets': [4],
                'orderable': false,
                'class': 'text-center text-nowrap',
                'width': '8%',
            },
            {
                'targets': [2, 3],
                'className': 'text-right',
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
                data: function (row) {
                    return '<a href="#" data-id="'+ row.id +'" class="show-btn">' + row.name + '</a>';
                },
                name: 'name',
            },
            {
                data: 'brand.name',
                name: 'brand.name',
            },
            {
                data: function (row) {
                    return !isEmpty(row.selling_price) ? '<p class="cur-margin">' +
                        getCurrentCurrencyClass() + ' ' +
                        addCommas(row.selling_price) + '</p>' : 'N/A';
                },
                name: 'selling_price',
            },
            {
                data: function (row) {
                    return !isEmpty(row.buying_price) ? '<p class="cur-margin">' +
                        getCurrentCurrencyClass() + ' ' +
                        addCommas(row.buying_price) + '</p>' : 'N/A';
                },
                name: 'buying_price',
            },
            {
                data: function (row) {
                    let data = [
                        {
                            'id': row.id,
                            'url': medicineUrl + '/' + row.id + '/edit',
                        }];
                    return prepareTemplateRender('.pageActionTemplate', data);
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
    let id = $(event.currentTarget).data('id');
    deleteItem(medicineUrl + '/' + id, '#tblMedicines', 'Medicine');
});

$(document).on('click', '.show-btn', function (event) {
    let medicineId = $(event.currentTarget).attr('data-id');
    renderData(medicineId);
});

window.renderData = function (id) {
    $.ajax({
        url: route('medicines.show.modal', id),
        type: 'GET',
        success: function (result) {
            if (result.success) {
                $('#medicine_name').text(result.data.name);
                $('#medicine_brand').text(result.data.brand.name);
                $('#medicine_category').text(result.data.category.name);
                $('#salt_composition').text(result.data.salt_composition);
                $('#selling_price').text(currentCurrency+' '+addCommas(result.data.selling_price));
                $('#buying_price').text(currentCurrency+' '+addCommas(result.data.buying_price));
                $('#side_effects').text(result.data.side_effects);
                $('#created_on').
                    text(moment(result.data.created_at).fromNow());
                $('#updated_on').
                    text(moment(result.data.updated_at).fromNow());
                $('#description').text(result.data.description);

                setValueOfEmptySpan();
                $('#showMedicine').appendTo('body').modal('show');
            }
        },
        error: function (result) {
            displayErrorMessage(result.responseJSON.message);
        },
    });
};

