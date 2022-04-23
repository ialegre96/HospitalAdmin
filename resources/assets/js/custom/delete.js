'use strict';

window.deleteItem = function (url, tableId, header, callFunction = null) {
    const swalWithBootstrapButtons = Swal.mixin({
        customClass: {
            confirmButton: 'swal2-confirm btn fw-bold btn-danger mt-0',
            cancelButton: 'swal2-cancel btn fw-bold btn-bg-light btn-color-primary mt-0'
        },
        buttonsStyling: false
    })
    
    swalWithBootstrapButtons.fire({
        title: 'Delete !',
        text: 'Are you sure want to delete this "' + header + '" ?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#D9214E',
        cancelButtonText: 'No, Cancel',
        confirmButtonText: 'Yes, Delete',
    }).then((result) => {
        if (result.isConfirmed) {
            deleteItemAjax(url, tableId, header, callFunction = null);
        }
    });
};

function deleteItemAjax(url, tableId, header, callFunction = null) {
    $.ajax({
        url: url,
        type: 'DELETE',
        dataType: 'json',
        success: function (obj) {
            if (obj.success) {

                if ($(tableId).DataTable().data().count() == 1) {
                    $(tableId).DataTable().page('previous').draw('page');
                } else {
                    $(tableId).DataTable().ajax.reload(null, false);
                }
            }
            Swal.fire({
                icon: 'success',
                title: 'Deleted!',
                confirmButtonColor: '#009ef7',
                text: header + ' has been deleted.',
                timer: 2000,
            });
            if (callFunction) {
                eval(callFunction);
            }
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
