'use strict';

$(document).ready(function () {
    let tableName = '#tblIpdConsultantRegisters';
    let tbl = $('#tblIpdConsultantRegisters').DataTable({
        processing: true,
        serverSide: true,
        searchDelay: 500,
        'language': {
            'lengthMenu': 'Show _MENU_',
        },
        'order': [[1, 'desc']],
        ajax: {
            url: ipdConsultantRegisterUrl,
            data: function (data) {
                data.id = ipdPatientDepartmentId;
            },
        },
        columnDefs: [
            {
                'targets': [0, 1, 2],
                'width': '10%',
            },
            {
                'targets': [3],
                'className': 'text-center text-nowrap',
                'orderable': false,
                'width': '4%',
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
                    let showLink = doctorUrl + '/' + row.doctor_id;
                    return `<div class="d-flex align-items-center">
                        <div class="symbol symbol-circle symbol-50px overflow-hidden me-3">
                        <a href="${showLink}">
                            <div>
                                <img src="${row.doctorImageUrl}" alt=""
                                     class="user-img">
                            </div>
                        </a>
                        </div>
                        <div class="d-flex flex-column">
                            <a href="${showLink}"
                               class="mb-1">${row.doctor.user.full_name}</a>
                            <span>${row.doctor.user.email}</span>
                        </div>
                    </div>`;
                },
                name: 'doctor.user.first_name',
            },
            {
                data: function (row) {
                    return row;
                },
                render: function (row) {
                    if (row.applied_date === null) {
                        return 'N/A';
                    }

                    return `<div class="badge badge-light">
                                <div class="mb-2">${moment(row.applied_date).format('LT')}</div>
                                <div>${moment(row.applied_date).format('Do MMM, Y')}</div>
                            </div>`;
                },
                name: 'applied_date',
            },
            {
                data: function (row) {
                    return row;
                },
                render: function (row) {
                    if (row.instruction_date === null) {
                        return 'N/A';
                    }

                    return `<div class="badge badge-light">
                                <div>${moment(row.instruction_date).format('Do MMM, Y')}</div>
                            </div>`;
                },
                name: 'instruction_date',
            },
            {
                data: function (row) {
                    let data = [{ 'id': row.id }];
                    return prepareTemplateRender(
                        '#ipdConsultantRegisterActionTemplate',
                        data);
                }, name: 'doctor.user.last_name',
            },
        ],
    });
    searchDataTable(tbl,'#search-table-2');

    function searchDataTable(tbl, selector)
    {
        const filterSearch = document.querySelector(selector);
        filterSearch.addEventListener('keyup', function (e) {
            tbl.search(e.target.value).draw();
        });
    }

    const addDateTimePicker = () => {
        $('.appliedDate').flatpickr({
            enableTime: true,
            dateFormat: "Y-m-d H:i",
            useCurrent: false,
            sideBySide: true,
            widgetPositioning: {
                horizontal: 'left',
                vertical: 'bottom',
            },
            minDate: ipdPatientCaseDate,
        });

        $('.instructionDate').flatpickr({
            enableTime: false,
            format: 'YYYY-MM-DD',
            useCurrent: false,
            sideBySide: true,
            widgetPositioning: {
                horizontal: 'left',
                vertical: 'bottom',
            },
            minDate: ipdPatientCaseDate,
        });
    };

    addDateTimePicker();

    const dropdownToSelect2 = (selector) => {
        $(selector).select2({
            placeholder: 'Select Doctor',
            width: '100%',
        });
    };

    const removeReadOnlyAttrInDate = (selector) => {
        $(selector).attr('readonly', false);
    };

    dropdownToSelect2('.doctorId');
    removeReadOnlyAttrInDate('.appliedDate');
    removeReadOnlyAttrInDate('.instructionDate');

    $(document).on('click', '#addItem', function () {
        let data = {
            'doctors': doctors,
            'uniqueId': uniqueId,
        };
        let ipdConsultantItemHtml = prepareTemplateRender(
            '#ipdConsultantInstructionItemTemplate', data);
        $('.ipd-consultant-item-container').append(ipdConsultantItemHtml);
        dropdownToSelect2('.doctorId');
        addDateTimePicker();
        removeReadOnlyAttrInDate('.appliedDate');
        removeReadOnlyAttrInDate('.instructionDate');
        uniqueId++;

        resetIpdConsultantItemIndex();
    });

    const resetIpdConsultantItemIndex = () => {
        let index = 1;
        $('.ipd-consultant-item-container>tr').each(function () {
            $(this).find('.item-number').text(index);
            index++;
        });
        if (index - 1 == 0) {
            let data = {
                'doctors': doctors,
                'uniqueId': uniqueId,
            };
            let ipdConsultantItemHtml = prepareTemplateRender(
                '#ipdConsultantInstructionItemTemplate', data);
            $('.ipd-consultant-item-container').append(ipdConsultantItemHtml);
            dropdownToSelect2('.doctorId');
            addDateTimePicker();
            uniqueId++;
        }
    };

    $(document).on('click', '.deleteIpdConsultantInstruction', function () {
        $(this).parents('tr').remove();
        resetIpdConsultantItemIndex();
    });

    $(document).on('click', '.delete-consultant-btn', function (event) {
        let id = $(event.currentTarget).data('id');
        deleteItem(ipdConsultantRegisterUrl + '/' + id, tableName,
            'IPD Consultant Instruction');
    });

    $(document).on('submit', '#addIpdConsultantNewForm', function (event) {
        event.preventDefault();
        let loadingButton = jQuery(this).find('#btnIpdConsultantSave');
        loadingButton.button('loading');
        let data = {
            'formSelector': $(this),
            'url': ipdConsultantRegisterCreateUrl,
            'type': 'POST',
            'tableSelector': tableName,
        };
        newRecord(data, loadingButton, '#addConsultantInstructionModal');
    });

    $(document).on('click', '.edit-consultant-btn', function (event) {
        if (ajaxCallIsRunning) {
            return;
        }
        ajaxCallInProgress();
        let ipdConsultantId = $(event.currentTarget).data('id');
        renderConsultantData(ipdConsultantId);
    });

    window.renderConsultantData = function (id) {
        $.ajax({
            url: ipdConsultantRegisterUrl + '/' + id + '/edit',
            type: 'GET',
            success: function (result) {
                if (result.success) {
                    $('#ipdEditConsultantId').val(result.data.id);
                    document.querySelector('#ipdEditAppliedDate')._flatpickr.setDate(moment(result.data.applied_date).format());
                    $('#editDoctorId').val(result.data.doctor_id).trigger('change.select2');
                    document.querySelector('#editInstructionDate')._flatpickr.setDate(moment(result.data.instruction_date).format());
                    $('#editConsultantInstruction').val(result.data.instruction);
                    $('#editIpdConsultantInstructionModal').modal('show');
                    ajaxCallCompleted();
                }
            },
            error: function (result) {
                manageAjaxErrors(result);
            },
        });
    };

    $(document).on('submit', '#editIpdConsultantNewForm', function (event) {
        event.preventDefault();
        let loadingButton = jQuery(this).find('#btnEditIpdConsultantSave');
        loadingButton.button('loading');
        let id = $('#ipdEditConsultantId').val();
        let url = ipdConsultantRegisterUrl + '/' + id;
        let data = {
            'formSelector': $(this),
            'url': url,
            'type': 'POST',
            'tableSelector': tableName,
        };
        editRecord(data, loadingButton, '#editIpdConsultantInstructionModal');
    });

    $('#addConsultantInstructionModal').on('hidden.bs.modal', function () {
        resetModalForm('#addIpdConsultantNewForm', '#validationErrorsBox');
        $('#ipdConsultantInstructionTbl').find('tr:gt(1)').remove();
        $('.doctorId').val('');
        $('.doctorId').trigger('change');
    });
});
