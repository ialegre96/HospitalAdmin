'use strict';

$(document).ready(function () {
    let tableName = '#tblIpdPrescription';
    let tbl = $(tableName).DataTable({
        processing: true,
        serverSide: true,
        searchDelay: 500,
        'language': {
            'lengthMenu': 'Show _MENU_',
        },
        'order': [[0, 'desc']],
        ajax: {
            url: ipdPrescriptionUrl,
            data: function (data) {
                data.id = ipdPatientDepartmentId;
            },
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
                    return '<a href="javascript:void(0)" class="viewIpdPrescription badge badge-light-info" data-pres-id="' +
                        row.id + '">' +
                        row.patient.ipd_number +
                        '</a>';
                },
                name: 'patient.ipd_number',
            },
            {
                data: function (row) {
                    return row;
                },
                render: function (row) {
                    if (row.created_at === null) {
                        return 'N/A';
                    }

                    return moment(row.created_at).format('Do MMM, Y');
                },
                name: 'created_at',
            },
        ],
    });
    handleSearchDatatable(tbl);

    $(document).on('click', '.viewIpdPrescription', function () {
        $.ajax({
            url: ipdPrescriptionUrl + '/' + $(this).data('pres-id'),
            type: 'get',
            success: function (result) {
                $('#ipdPrescriptionViewData').html(result);
                $('#showIpdPrescriptionModal').modal('show');
                ajaxCallCompleted();
            },
        });
    });

    $(document).on('click', '.printPrescription', function () {
        let divToPrint = document.getElementById('DivIdToPrint');
        let newWin = window.open('', 'Print-Window');
        newWin.document.open();
        newWin.document.write(
            '<html><link href="' + bootstarpUrl +
            '" rel="stylesheet" type="text/css"/>' +
            '<body onload="window.print()">' + divToPrint.innerHTML +
            '</body></html>');
        newWin.document.close();
        setTimeout(function () {newWin.close();}, 10);
    });
});
