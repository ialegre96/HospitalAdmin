'use strict';

$(document).ready(function () {
    let tableName = '#visitorTbl';
    let tbl = $('#visitorTbl').DataTable({
        processing: true,
        serverSide: true,
        searchDelay: 500,
        'language': {
            'lengthMenu': 'Show _MENU_',
        },
        'order': [10, 'desc'],
        ajax: {
            url: visitorUrl,
            data: function (data) {
                data.purpose = $('#purposeArr').find('option:selected').val();
            },
        },
        columnDefs: [
            {
                'targets': [9],
                'orderable': false,
                'className': 'text-center text-nowrap',
                'width': '8%',
            },
            {
                'targets': [8],
                'orderable': false,
            },
            {
                'targets': [10],
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
                    if (row.purpose == 1) {
                        return 'Visit';
                    } else if (row.purpose == 2) {
                        return 'Enquiry';
                    } else {
                        return 'Seminar';
                    }
                },
                name: 'purpose',
            },
            {
                data: 'name',
                name: 'name',
            },
            {
                data: function (row) {
                    return isEmpty(row.phone) ? 'N/A' : row.phone;
                },
                name: 'phone',
            },
            {
                data: function (row) {
                    return isEmpty(row.id_card) ? 'N/A' : row.id_card;
                },
                name: 'id_card',
            },
            {
                data: function (row) {
                    return isEmpty(row.no_of_person) ? 'N/A' : row.no_of_person;
                },
                name: 'no_of_person',
            },
            {
                data: function (row) {
                    if (row.date === null) {
                        return 'N/A';
                    }
                    return `<div class="badge badge-light">
                                <div>${moment(row.date).format('Do MMM, Y')}</div>
                            </div>`;
                },
                name: 'date',
            },
            {
                data: function (row) {
                    return isEmpty(row.in_time) ? 'N/A' : row.in_time;
                },
                name: 'in_time',
            },
            {
                data: function (row) {
                    return isEmpty(row.out_time) ? 'N/A' : row.out_time;
                },
                name: 'out_time',
            },
            {
                data: function (row) {
                    if (row.document_url != '') {
                        let downloadLink = downloadDocumentUrl + '/' + row.id;
                        return '<a href="' + downloadLink + '">' + 'Download' +
                            '</a>';
                    }
                    return 'N/A';
                },
                name: 'id',
            },
            {
                data: function (row) {
                    let url = visitorUrl + row.id;
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
            $(document).on('change', '#purposeArr', function () {
                $(tableName).DataTable().ajax.reload(null, true);
            });
        },
    });
    handleSearchDatatable(tbl);
});

$(document).on('click', '.delete-btn', function (event) {
    let visitorId = $(event.currentTarget).data('id');
    deleteItem(visitorUrl + visitorId, '#visitorTbl', 'Visitor');
});

$(document).ready(function () {
    $('#purposeArr').select2({
        width: '100%',
    });
});

$(document).on('click', '#resetFilter', function () {
    $('#purposeArr').val(0).trigger('change');
});
