'use strict';

$(document).ready(function () {
    let tableName = '#tblIpdPrescription';
    let tbl = $('#tblIpdPrescription').DataTable({
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
                'targets': [2],
                'className': 'text-center text-nowrap',
                'orderable': false,
                'width': '8%',
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

                    return `<div class="badge badge-light">
                                <div>${moment(row.created_at).format('Do MMM, Y')}</div>
                            </div>`;
                },
                name: 'created_at',
            },
            {
                data: function (row) {
                    let data = [{ 'id': row.id }];
                    return prepareTemplateRender(
                        '#ipdPrescriptionActionTemplate',
                        data);
                }, name: 'id',
            },
        ],
    });
    searchDataTable(tbl,'#search-table-4');

    function searchDataTable(tbl, selector)
    {
        const filterSearch = document.querySelector(selector);
        filterSearch.addEventListener('keyup', function (e) {
            tbl.search(e.target.value).draw();
        });
    }

    $(document).on('click', '.delete-prescription-btn', function (event) {
        let id = $(event.currentTarget).data('id');
        deleteItem(ipdPrescriptionUrl + '/' + id, tableName,
            'IPD Prescription');
    });

    const dropdownToSelect2 = (selector) => {
        $(selector).select2({
            placeholder: 'Select Category',
            width: '100%',
        });
    };

    dropdownToSelect2('.categoryId');

    const medicineSelect2 = (selector) => {
        $(selector).select2({
            width: '100%',
        });
    };

    $(document).
        on('click', '#addPrescriptionItem, #addPrescriptionItemOnEdit',
            function () {
                const itemSelector = (parseInt($(this).data('edit')))
                    ? '#editIpdPrescriptionItemTemplate'
                    : '#ipdPrescriptionItemTemplate';
                const tbodyItemSelector = (parseInt($(this).data('edit')))
                    ? '.edit-ipd-prescription-item-container'
                    : '.ipd-prescription-item-container';
                let data = {
                    'medicineCategories': medicineCategories,
                    'uniqueId': uniqueId,
                };
                let ipdPrescriptionItemHtml = prepareTemplateRender(
                    itemSelector, data);
                $(tbodyItemSelector).append(ipdPrescriptionItemHtml);
                dropdownToSelect2('.categoryId');
                uniqueId++;

                resetIpdPrescriptionItemIndex(parseInt($(this).data('edit')));
            });

    const resetIpdPrescriptionItemIndex = (itemMode) => {
        const itemSelector = (itemMode)
            ? '#editIpdPrescriptionItemTemplate'
            : '#ipdPrescriptionItemTemplate';
        const tbodyItemSelector = (itemMode)
            ? '.edit-ipd-prescription-item-container'
            : '.ipd-prescription-item-container';
        const itemNo = (itemMode)
            ? '.edit-prescription-item-number'
            : '.prescription-item-number';

        let index = 1;
        $(tbodyItemSelector + '>tr').each(function () {
            $(this).find(itemNo).text(index);
            index++;
        });
        if (index - 1 == 0) {
            let data = {
                'medicineCategories': medicineCategories,
                'uniqueId': uniqueId,
            };
            let ipdPrescriptionItemHtml = prepareTemplateRender(
                itemSelector, data);
            $(tbodyItemSelector).append(ipdPrescriptionItemHtml);
            dropdownToSelect2('.categoryId');
            uniqueId++;
        }
    };

    $(document).
        on('click', '.deleteIpdPrescription, .deleteIpdPrescriptionOnEdit',
            function () {
                $(this).parents('tr').remove();
                resetIpdPrescriptionItemIndex(parseInt($(this).data('edit')));
            });

    $(document).on('change', '.categoryId', function (e, rData) {
        const medicineId = $(document).
            find('[data-medicine-id=\'' + $(this).data('id') + '\']');
        if ($(this).val() !== '') {
            $.ajax({
                url: medicinesListUrl,
                type: 'get',
                dataType: 'json',
                data: { id: $(this).val() },
                success: function (data) {
                    if (data.data.length !== 0) {
                        medicineId.empty();
                        medicineId.removeAttr('disabled');
                        medicineSelect2('.medicineId');
                        $.each(data.data, function (i, v) {
                            medicineId.
                                append($('<option></option>').
                                    attr('value', i).
                                    text(v));
                        });

                        if (typeof rData != 'undefined') {
                            medicineId.val(rData.medicineId).
                                trigger('change.select2');
                        }
                    } else {
                        medicineId.prop('disabled', true);
                    }
                },
            });
        }
        medicineId.empty();
        medicineId.prop('disabled', true);
    });

    $(document).on('submit', '#addIpdPrescriptionForm', function (event) {
        event.preventDefault();
        let loadingButton = jQuery(this).find('#btnIpdPrescriptionSave');
        loadingButton.button('loading');
        let data = {
            'formSelector': $(this),
            'url': ipdPrescriptionCreateUrl,
            'type': 'POST',
            'tableSelector': tableName,
        };
        newRecord(data, loadingButton, '#addIpdPrescriptionModal');
    });

    $(document).on('click', '.edit-prescription-btn', function (event) {
        if (ajaxCallIsRunning) {
            return;
        }
        ajaxCallInProgress();
        let ipdPrescriptionId = $(event.currentTarget).data('id');
        renderPrescriptionData(ipdPrescriptionId);
    });

    window.renderPrescriptionData = function (id) {
        $.ajax({
            url: ipdPrescriptionUrl + '/' + id + '/edit',
            type: 'GET',
            success: function (result) {
                if (result.success) {
                    let ipdPrescriptionData = result.data.ipdPrescription;
                    let ipdPrescriptionItemsData = result.data.ipdPrescriptionItems;
                    $('#ipdEditPrescriptionId').val(ipdPrescriptionData.id);
                    $('#editHeaderNote').val(ipdPrescriptionData.header_note);
                    $('#editFooterNote').val(ipdPrescriptionData.footer_note);

                    $.each(ipdPrescriptionItemsData, function (i, v) {
                        $('#addPrescriptionItemOnEdit').trigger('click');
                        let rowId = uniqueId - 1;
                        $(document).
                            find('[data-id=\'' + rowId + '\']').
                            val(v.category_id).
                            trigger('change', [{ medicineId: v.medicine_id }]);
                        $(document).
                            find('[data-dosage-id=\'' + rowId + '\']').
                            val(v.dosage);
                        $(document).
                            find('[data-instruction-id=\'' + rowId + '\']').
                            val(v.instruction);
                    });

                    let index = 1;
                    $('.edit-ipd-prescription-item-container>tr').
                        each(function () {
                            $(this).
                                find('.prescription-item-number').
                                text(index);
                            index++;
                        });

                    $('#editIpdPrescriptionModal').modal('show');
                    ajaxCallCompleted();
                }
            },
            error: function (result) {
                manageAjaxErrors(result);
            },
        });
    };

    $(document).on('submit', '#editIpdPrescriptionForm', function (event) {
        event.preventDefault();
        let loadingButton = jQuery(this).find('#btnEditIpdPrescriptionSave');
        loadingButton.button('loading');
        let id = $('#ipdEditPrescriptionId').val();
        let url = ipdPrescriptionUrl + '/' + id;
        let data = {
            'formSelector': $(this),
            'url': url,
            'type': 'POST',
            'tableSelector': tableName,
        };
        editRecord(data, loadingButton, '#editIpdPrescriptionModal');
    });

    $(document).on('click', '.viewIpdPrescription', function () {
        $.ajax({
            url: ipdPrescriptionUrl + '/' + $(this).data('pres-id'),
            type: 'get',
            beforeSend: function () {
                screenLock();
            },
            success: function (result) {
                $('#ipdPrescriptionViewData').html(result);
                $('#showIpdPrescriptionModal').modal('show');
                ajaxCallCompleted();
            },
            complete: function () {
                screenUnLock();
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
        setTimeout(function () {
            newWin.close();
        }, 10);
    });

    $('#addIpdPrescriptionModal').on('hidden.bs.modal', function () {
        resetModalForm('#addIpdPrescriptionForm', '#validationErrorsBox');
        $('#ipdPrescriptionTbl').find('tr:gt(1)').remove();
        $('.categoryId').val('');
        $('.categoryId').trigger('change');
    });

    $('#addIpdPrescriptionModal').on('shown.bs.modal', function () {
        medicineSelect2('.medicine_id');
    });

    $('#editIpdPrescriptionModal').on('hidden.bs.modal', function () {
        $('#editIpdPrescriptionTbl').find('tr:gt(0)').remove();
    });

});
