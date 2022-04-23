'use strict';

$(document).ready(function () {
    let tbl = '#hospitalUser';
    let table = $(tbl).DataTable({
        searchDelay: 500,
        processing: true,
        serverSide: true,
        'language': {
            'lengthMenu': 'Show _MENU_',
        },
        'order': [[5, 'desc']],
        ajax: {
            url: showUrl,
            data: function (data) {
                data.department_id = $('#roleArr').
                    find('option:selected').
                    val();
                data.status = $('#statusArr').find('option:selected').val();
                data.id = $('#hospitalId').val();
            },
        },
        columnDefs: [
            {
                'targets': [2],
                'orderable': true,
            },
            {
                'targets': [3],
                'orderable': true,
            },
            {
                'targets': [4],
                'orderable': false,
            },
            {
                'targets': [5],
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
                    return `<div class="d-flex align-items-center">
                                <div class="symbol symbol-circle symbol-50px overflow-hidden me-3">
                                    <a href="#" data-id="${row.id}" class="show-btn">
                                        <div>
                                            <img src="${row.image_url}" alt=""
                                                 class="user-img">
                                        </div>
                                    </a>
                                </div>
                            <div class="d-flex flex-column">
                                <span class="mb-1 show-btn" data-id="${row.id}">${row.full_name}</span>
                            </div>
                    </div>`;
                },
                name: 'first_name',
            },
            {
                data: function (row) {
                    return `<span class="badge badge-light-info fs-6">${row.roles[0].name}</span>`;
                },
                name: 'last_name',
            },
            {
                data: 'email',
                name: 'email',
            },
            {
                data: 'phone',
                name: 'phone',
            },
            {
                data: function (row) {
                    return `<span class="badge badge-light-${row.status == 1
                        ? 'success'
                        : 'danger'}">${row.status == 1
                        ? 'Active'
                        : 'Deactive'}</span>`;
                },
                name: 'status',
            },
            {
                data: function (row) {
                    return `<div class="badge badge-light">
                                <div class="mb-2">${moment(row.created_at).
                        format('LT')}</div>
                                <div>${moment(row.created_at).
                        format('Do MMM, Y')}</div>
                            </div>`;
                },
                name: 'created_at',
            },
            {
                data: function (row) {
                    if (row.status === 1) {
                        return `<a href="javascript:void(0)" data-id="${row.id}" class="btn btn-primary btn-sm user-impersonate">
                               Impersonate
                            </a>`;
                    } else {
                        return '<span class="text text-center">N/A</span>';
                    }
                }, name: 'id',
            },
        ],
        'fnInitComplete': function () {
            $(document).on('change', '#roleArr, #statusArr', function () {
                $(tbl).DataTable().ajax.reload(null, true);
            });
        },
    });

    handleSearchDatatable(table);
});

$(document).on('click', '#resetFilter', function () {
    $('#roleArr, #statusArr').val('').trigger('change');
});

$(document).on('contextmenu', '.user-impersonate', function (e) {
    e.preventDefault(); // Stop right click on link
    return false;
});

var control = false;
$(document).on('keyup keydown', function (e) {
    control = e.ctrlKey;
});

$(document).on('click', '.user-impersonate', function () {
    if (control) {
        return false; // Stop ctrl + click on link
    }
    let id = $(this).data('id');
    let element = document.createElement('a');
    element.setAttribute('href', userUrl + '/' + id + '/login');
    document.body.appendChild(element);
    element.click();
    document.body.removeChild(element);
    $('.user-impersonate').prop('disabled', true);
});

