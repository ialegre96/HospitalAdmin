'use strict';

$(document).ready(function () {
    let tbl = $('#employeeDoctorsTable').DataTable({
        processing: true,
        serverSide: true,
        searchDelay: 500,
        'language': {
            'lengthMenu': 'Show _MENU_',
        },
        'order': [[0, 'asc']],
        ajax: {
            url: doctorUrl,
        },
        columnDefs: [
            {
                targets: '_all',
                defaultContent: 'N/A',
                'className': 'text-start align-middle text-nowrap',
            },
        ],
        columns: [
            {
                data: function (row) {
                    let showLink = doctorShowUrl + '/' + row.id;
                    return `<div class="d-flex align-items-center">
                            <div class="symbol symbol-circle symbol-50px overflow-hidden me-3">
                                <a href="${showLink}">
                                    <div class="">
                                        <img src="${row.image_url}" alt="" class="user-img">
                                    </div>
                                </a>
                           </div>
                           <div class="d-flex flex-column">
                                <a href="${showLink}" class="mb-1">${row.user.full_name}</a>
                                <span>${row.user.email}</span>
                            </div>
                         </div>`;
                },
                name: 'user.first_name',
            },
            {
                data: 'specialist',
                name: 'specialist',
            },
            {
                data: function (row) {
                    if (row.user.status == 1)
                        return `<span class="badge badge-light-success">Active</span>`;
                    else
                        return `<span class="badge badge-light-danger">Deactive</span>`;
                },
                name: 'user.status',
            },
        ],
    });
    handleSearchDatatable(tbl);
});
