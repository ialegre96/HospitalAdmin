'use strict';

$(document).ready(function () {
    let tables = [
        '#patientCases',
        '#patientAdmissions',
        '#patientAppointments',
        '#patientBills',
        '#patientInvoices',
        '#patientAdvancedPayments',
        '#patientDocuments',
        '#patientVaccinated'];

    $.each(tables, function (index, value) {
        let tbl = $(value).DataTable({
            'language': {
                'lengthMenu': 'Show _MENU_',
            },
        });
        searchDataTable(tbl, '#search-table-' + (index + 1));
    });

    function searchDataTable(tbl, selector) {
        const filterSearch = document.querySelector(selector);
        filterSearch.addEventListener('keyup', function (e) {
            tbl.search(e.target.value).draw();
        });
    }

    // Edit And Delete AdvancedPayment Modal
    $('#editDate').flatpickr({
        dateFormat: 'Y-m-d',
    });

    $('#editAdvancedPaymentModal').on('shown.bs.modal', function () {
        $('#editPatientId:first').focus();
    });

    $(document).on('click', '.edit-advancedPayment-btn', function (event) {
        if (ajaxCallIsRunning) {
            return;
        }
        ajaxCallInProgress();
        let advancedPaymentId = $(event.currentTarget).data('id');
        renderData(advancedPaymentId);
    });

    window.renderData = function (id) {
        $.ajax({
            url: advancedPaymentUrl + '/' + id + '/edit',
            type: 'GET',
            success: function (result) {
                if (result.success) {
                    $('#advancePaymentId').val(result.data.id);
                    $('#editPatientId').val(result.data.patient_id).trigger('change.select2');
                    $('#editReceiptNo').val(result.data.receipt_no);
                    $('#editAmount').val(result.data.amount);
                    $('.price-input').trigger('input');
                    document.querySelector('#editDate')._flatpickr.setDate(moment(result.data.date).format());
                    $('#editAdvancedPaymentModal').modal('show');
                    ajaxCallCompleted();
                }
            },
            error: function (result) {
                manageAjaxErrors(result);
            },
        });
    };

    $(document).on('submit', '#editAdvancedPaymentForm', function (event) {
        event.preventDefault();
        let loadingButton = jQuery(this).find('#btnEditSave');
        loadingButton.button('loading');
        let id = $('#advancePaymentId').val();
        $.ajax({
            url: advancedPaymentUrl + '/' + id,
            type: 'patch',
            data: $(this).serialize(),
            success: function (result) {
                if (result.success) {
                    displaySuccessMessage(result.message);
                    $('#editAdvancedPaymentModal').modal('hide');
                    location.reload();
                }
            },
            error: function (result) {
                manageAjaxErrors(result);
            },
            complete: function () {
                loadingButton.button('reset');
            },
        });
    });

    $('#editAdvancedPaymentModal').on('hidden.bs.modal', function () {
        resetModalForm('#editAdvancedPaymentForm', '#editValidationErrorsBox');
    });

    // Edit And Delete Vaccination Modal
    $('#editDoesGivenDate').flatpickr({
        enableTime: true,
        defaultDate: new Date(),
        dateFormat: 'Y-m-d H:i',
    });

    $('#editPatientName, #editVaccinationName').select2({
        width: '100%',
    });

    $(document).on('click', '.edit-vaccination-btn', function (event) {
        if (ajaxCallIsRunning) {
            return;
        }
        ajaxCallInProgress();
        let vaccinatedPatientId = $(event.currentTarget).attr('data-id');
        renderVaccinationData(vaccinatedPatientId);
    });

    window.renderVaccinationData = function (id) {
        $.ajax({
            url: vaccinatedPatientUrl + '/' + id + '/edit',
            type: 'GET',
            success: function (result) {
                if (result.success) {
                    let vaccinatedPatient = result.data;
                    $('#vaccinatedPatientId').val(vaccinatedPatient.id);
                    $('#editPatientName').val(vaccinatedPatient.patient_id).trigger('change.select2');
                    $('#editVaccinationName').val(vaccinatedPatient.vaccination_id).trigger('change.select2');
                    $('#editSerialNo').val(vaccinatedPatient.vaccination_serial_number);
                    $('#editDoseNumber').val(vaccinatedPatient.dose_number);
                    document.querySelector('#editDoesGivenDate')._flatpickr.setDate(moment(vaccinatedPatient.dose_given_date).format());
                    $('#editDescription').val(vaccinatedPatient.description);
                    $('#editVaccinationModal').modal('show');
                    ajaxCallCompleted();
                }
            },
            error: function (result) {
                manageAjaxErrors(result);
            },
        });
    };

    $(document).on('submit', '#editVaccinationForm', function (event) {
        event.preventDefault();
        let loadingButton = jQuery(this).find('#editBtnSave');
        loadingButton.button('loading');
        let id = $('#vaccinatedPatientId').val();
        $.ajax({
            url: vaccinatedPatientUrl + '/' + id + '/update',
            type: 'post',
            data: $(this).serialize(),
            success: function (result) {
                if (result.success) {
                    displaySuccessMessage(result.message);
                    $('#editVaccinationModal').modal('hide');
                    location.reload();
                }
            },
            error: function (result) {
                manageAjaxErrors(result);
            },
            complete: function () {
                loadingButton.button('reset');
            },
        });
    });

    $('#editVaccinationModal').on('hidden.bs.modal', function () {
        resetModalForm('#editVaccinationForm', '#editValidationErrorsBox1');
    });

    $(document).on('click', '.delete-btn', function (event) {
        let Ele = $(this);
        let id = $(event.currentTarget).data('id');
        let url = $(this).data('url');
        let message = $(this).data('message');
        const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                confirmButton: 'swal2-confirm btn fw-bold btn-danger mt-0',
                cancelButton: 'swal2-cancel btn fw-bold btn-bg-light btn-color-primary mt-0'
            },
            buttonsStyling: false
        })
        swalWithBootstrapButtons.fire({
            title: 'Delete !',
            text: 'Are you sure want to delete this "' + message + '" ?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#5cb85c',
            cancelButtonColor: '#d33',
            cancelButtonText: 'No',
            confirmButtonText: 'Yes',
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: url + '/' + id,
                    type: 'DELETE',
                    dataType: 'json',
                    success: function (obj) {
                        if (obj.success) {
                            Ele.parent().parent().remove();
                        }
                        Swal.fire({
                            icon: 'success',
                            title: 'Deleted!',
                            confirmButtonColor: '#009ef7',
                            text: message + ' has been deleted.',
                            timer: 2000,
                        });
                    },
                    error: function (data) {
                        Swal.fire({
                            title: '',
                            text: data.responseJSON.message,
                            confirmButtonColor: '#009ef7',
                            icon: 'error',
                            timer: 5000,
                        })
                    },
                })
            }
        });
    });
});
