'use strict';

$(document).ready(function () {
    let tbl = $('#chargeCategoriesTbl').DataTable({
        processing: true,
        serverSide: true,
        searchDelay: 500,
        'language': {
            'lengthMenu': 'Show _MENU_',
        },
        'order': [[4, 'desc']],
        ajax: {
            url: chargeCategoryUrl,
        },
        columnDefs: [
            {
                'targets': [3],
                'orderable': false,
                'className': 'text-center text-nowrap',
                'width': '8%',
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
                data: 'name',
                name: 'name',
            },
            {
                data: function (row) {
                    if (isEmpty(row.description)){
                        
                        return 'N/A';
                    }
                    let descriptionLen = row.description.length;
                    if (descriptionLen > 50){
                        
                        return  row.description.substring(0,50)+'...';
                    }

                    return row.description;
                },
                name: 'description',
            },
            {
                data: function (row) {
                    if (row.charge_type == 1) {
                        return '<span class="badge badge-light-primary">Procedures</span>';
                    } else if (row.charge_type == 2) {
                        return '<span class="badge badge-light-info">Investigations</span>';
                    } else if (row.charge_type == 3) {
                        return '<span class="badge badge-light-success">Supplier</span>';
                    } else if (row.charge_type == 4) {
                        return '<span class="badge badge-light-danger">Operation Theatre</span>';
                    } else {
                        return '<span class="badge badge-light-warning">Others</span>';
                    }

                }, name: 'charge_type',
            },
            {
                data: function (row) {
                    let data = [
                        {
                            'id': row.id,
                        }];
                    return prepareTemplateRender(
                        '#chargeCategoryActionTemplate',
                        data);
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
    let chargeCategoryId = $(event.currentTarget).data('id');
    deleteItem(chargeCategoryUrl + '/' + chargeCategoryId,
        '#chargeCategoriesTbl',
        'Charge Category');
});
