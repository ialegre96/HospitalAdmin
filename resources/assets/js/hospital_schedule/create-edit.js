'use strict';

$(document).on('submit', '#saveForm', function (event) {
    event.preventDefault();
    let data = new FormData($(this)[0]);
    $.ajax({
        url: route('checkRecord'),
        type: 'POST',
        data: $(this).serialize(),
        cache: false,
        success: function (result) {
            console.log(result);
            saveUpdateForm(data);
        },
        error: function (result) {
            Swal.fire({
                title: 'Delete !',
                text: result.responseJSON.message,
                type: 'warning',
                icon: 'warning',
                showCancelButton: true,
                closeOnConfirm: true,
                confirmButtonColor: '#266CB0',
                showLoaderOnConfirm: true,
                cancelButtonText: 'No, Cancel',
                confirmButtonText: 'Yes, Update!',
            }).then(function (result) {
                if (result.isConfirmed) {
                    saveUpdateForm(data)
                }
            });
        },
    })
});

function saveUpdateForm(data) {
    $.ajax({
        url: $(this).attr('action'),
        type: 'POST',
        data: data,
        processData: false,
        contentType: false,
        success: function (result) {
            if (result.success) {
                console.log(result.success);
                displaySuccessMessage(result.message);
                setTimeout(function () {
                    location.reload();
                }, 1500);
            }
        },
        error: function (result) {
            displayErrorMessage(result.message);
        },
        complete: function () {
        },
    });
}

$(document).on('change', 'select[name^="startTimes"]', function (e) {
    let selectedIndex = $(this)[0].selectedIndex;
    let endTimeOptions = $(this).closest('.weekly-row').find('select[name^="endTimes"] option');
    endTimeOptions.eq(selectedIndex + 1).prop('selected', true).trigger('change');
    endTimeOptions.each(function (index) {
        if (index <= selectedIndex) {
            $(this).attr('disabled', true);
        } else {
            $(this).attr('disabled', false);
        }
    });
});
