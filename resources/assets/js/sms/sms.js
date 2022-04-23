'use strict';

$(document).ready(function () {
    $('#userId, #roleId').select2({
        width: '100%',
        dropdownParent: $('#AddModal'),
    });

    let tableName = '#smsTable';
    let tbl = $(tableName).DataTable({
        searchDelay: 500,
        processing: true,
        serverSide: true,
        'language': {
            'lengthMenu': 'Show _MENU_',
        },
        'order': [[5, 'desc']],
        ajax: {
            url: smsUrl,
        },
        columnDefs: [
            {
                'targets': [3],
                'orderable': false,
                'className': 'text-center text-nowrap',
                'width': '10%',
            },
            {
                'targets': [4, 5],
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
                    if (row.user != null) {
                        return '<a href="#" class="show-btn" data-id="' + row.id + '">' +
                            row.user.full_name + '</a>';
                    } else {
                        return 'N/A';
                    }
                },
                name: 'user.first_name',
            },
            {
                data: function (row) {
                    return isEmpty(row.region_code) ? row.phone_number : '+' +
                        row.region_code + row.phone_number;
                },
                name: 'phone_number',
            },
            {
                data: 'send_by.full_name',
                name: 'sendBy.first_name',
            },
            {
                data: function (row) {
                    let data = [{'id': row.id}];
                    return prepareTemplateRender('#smsTemplate',
                        data);
                }, name: 'id',
            },
            {
                data: 'send_by.last_name',
                name: 'sendBy.last_name',
            },
            {
                data: 'created_at',
                name: 'created_at',
            },
        ],
    });

    handleSearchDatatable(tbl);

    $(document).on('click', '.show-btn', function (event) {
        let smsId = $(event.currentTarget).attr('data-id');
        renderData(smsId);
    });

    window.renderData = function (id) {
        $.ajax({
            url: route('sms.show.modal', id),
            type: 'GET',
            success: function (result) {
                if (result.success) {
                    $('#send_to').text(result.data.user ? result.data.user.full_name : 'N/A');
                    $('#user_role').text(result.data.user ? result.data.user.roles[0].name : 'N/A');
                    $('#sms_phone').text(result.data.phone_number);
                    $('#send_by').text(result.data.send_by? result.data.send_by.full_name : 'N/A');
                    $('#high_blood_pressure').text(result.data.high_blood_pressure);
                    $('#sms_message').text(result.data.message);
                    $('#sms_date').
                        text(moment(result.data.created_at).fromNow());
                    $('#updated_on').
                        text(moment(result.data.updated_at).fromNow());

                    setValueOfEmptySpan();
                    $('#showSms').appendTo('body').modal('show');
                }
            },
            error: function (result) {
                displayErrorMessage(result.responseJSON.message);
            },
        });
    };

    $(document).on('keypress', '#messageId', function (e) {
        var tval = $('#messageId').val(),
            tlength = tval.length,
            set = 160,
            remain = parseInt(set - tlength);
        if (remain <= 0 && e.which !== 0 && e.charCode !== 0) {
            $('#messageId').val((tval).substring(0, tlength - 1));
            displayErrorMessage(
                'The message may not be greater than 160 characters.');
            // $('#validationErrorsBox').html('The message may not be greater than 160 characters.').
            //     show();
        }
    });

    $(document).on('submit', '#addNewForm', function (event) {
        event.preventDefault();
        var loadingButton = jQuery(this).find('#btnSave');
        loadingButton.button('loading');
        $('#btnSave').attr('disabled', true);
        if ($('#number').is(':checked')) {
            $('#roleId').remove();
            $('#userId').remove();
        }
        $.ajax({
            url: createSmsUrl,
            type: 'POST',
            data: $(this).serialize(),
            success: function (result) {
                if (result.success) {
                    displaySuccessMessage(result.message);
                    $('#AddModal').modal('hide');
                    tbl.ajax.reload();
                    $('#btnSave').attr('disabled', false);
                }
            },
            error: function (result) {
                printErrorMessage('#validationErrorsBox', result);
                $('#btnSave').attr('disabled', false);
            },
            complete: function () {
                loadingButton.button('reset');
            },
        });
    });

    $(document).on('click', '.delete-btn', function (event) {
        let id = $(event.currentTarget).data('id');
        deleteItem(smsUrl + '/' + id, tableName, 'SMS');
    });

    $('#AddModal').on('hidden.bs.modal', function () {
        resetModalForm('#addNewForm', '#validationErrorsBox');
        $('#userId').val('').trigger('change.select2');
        $('#roleId').val('').trigger('change.select2');
        $('#valid-msg').addClass('hide');
        hide();
        $('#btnSave').attr('disabled', false);
    });

    $('.myclass').hide();
    $('#phoneNumber').prop('required', false);
    $(document).on('click', '.number', function () {
        if ($('.number').is(':checked')) {
            $('.myclass').show();
            $('.number').attr('value', 1);
            $('.role').hide();
            $('#roleId').prop('required', false);
            $('.send').hide();
            $('#userId').prop('required', false);
            $('#phoneNumber').prop('required', true);
        } else {
            $('#phoneNumber').prop('required', false);
            hide();
        }
    });

    function hide () {
        $('.myclass').hide();
        $('.number').attr('value', 0);
        $('.role').show();
        $('.send').show();
    }
});

$('#roleId').on('change', function () {
    if ($(this).val() !== '') {
        $.ajax({
            url: getUsersListUrl,
            type: 'get',
            dataType: 'json',
            data: { id: $(this).val() },
            success: function (data) {
                $('#userId').empty();
                $('#userId').removeAttr('disabled');
                $.each(data.data, function (i, v) {
                    $('#userId').
                        append($('<option></option>').attr('value', i).text(v));
                });
            },
        });
    }
    $('#userId').empty();
    $('#userId').prop('disabled', true);
});
