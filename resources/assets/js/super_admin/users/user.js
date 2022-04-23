'use strict';

$(document).ready(function () {
    let tableName = '#superAdminUsersTable';
    let tbl = $(tableName).DataTable({
        searchDelay: 500,
        processing: true,
        serverSide: true,
        'language': {
            'lengthMenu': 'Show _MENU_',
        },
        'order': [[2, 'desc']],
        ajax: {
            url: userUrl,
            data: function (data) {
                data.status = $('#statusArr').find('option:selected').val();
            },
        },
        columnDefs: [
            {
                'targets': [1],
                'className': 'text-center align-middle text-nowrap',
            },
            {
                'targets': [2],
                'className': 'text-center align-middle text-nowrap',
            },
            {
                'targets': [3],
                'width': 10,
                'orderable': false,
                'searchable': false,
            },
            {
                'targets': [4],
                'className': 'text-center align-middle text-nowrap',
                'width': 10,
                'orderable': false,
                'searchable': false,
            },
            {
                'targets': [5],
                'className': 'text-center align-middle text-nowrap',
                'orderable': false,
            },
            {
                'targets': [6],
                'className': 'text-center align-middle text-nowrap',
                'orderable': false,
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
                                <a href="${showUrl + '/' +
                    row.id}" class="mb-1 show-btn" data-id="${row.id}">${row.full_name}</a>
                                <span>${row.email}</span>
                            </div>
                    </div>`;
                },
                name: 'first_name',
            },
            {
                data: function (row) {
                    if (row.status == 1) {
                        return `<a href="${route('front',
                            row.username)}" class="show-btn text-blue" target="_blank">${row.username}<span class="ms-2"><i class="fas fa-external-link-alt url-external-link"></i></span></a>`;
                    } else {
                        return row.username;
                    }
                },
                name: 'username',
            },
            {
                data: function (row) {
                    return `<div className="badge badge-light">
                            <div className="mb-2">${moment(row.created_at).
                        format('LT')}</div>
                            <div>${moment(row.created_at).format('Do MMM, Y')}</div>
                            </div>`;
                },
                name: 'created_at',
            },
            {
                data: function (row) {
                    if (row.department) {
                        let checked = row.status == 0 ? '' : 'checked';
                        let data = [{ 'id': row.id, 'checked': checked }];
                        return prepareTemplateRender('#userStatusTemplate',
                            data);
                    }
                },
                name: 'status',
            },
            {
                data: function (row) {
                    if (row.email_verified_at == null) {
                        return `<div class="d-flex justify-content-center">
                                     <a href="javascript:void(0)" data-id="${row.id}"style="pointer-events: none;
                        cursor: default;" class="btn btn-sm btn-secondary user-impersonate">${impersonate}</a>
                                </div>`;
                    }else {
                        return `<div class="d-flex justify-content-center">
                                     <a href="javascript:void(0)" data-id="${row.id}"  class="btn btn-sm btn-primary user-impersonate">${impersonate}</a>
                                </div>`;
                        
                    }
                },
                name: '',
            },
            {
                data: function (row) {
                    let checked = row.email_verified_at == null
                        ? ''
                        : 'checked disabled';
                    if (row.department) {
                        return `<label class="form-check form-switch form-check-custom form-check-solid form-switch-sm justify-content-center">
                                 <input name="status" data-id="${row.id}" class="form-check-input is-verified" type="checkbox" value="1" ${checked}>
                                  <span class="switch-slider" data-checked="&#x2713;" data-unchecked="&#x2715;"></span>
                            </label>`;
                    }
                },
                name: 'email_verified_at',
            },
            {
                data: function (row) {
                    let url = hospitalUrl + '/' + row.id;
                    let data = [{ 'id': row.id, 'url': url + '/edit' }];
                    return prepareTemplateRender('#hospitalTemplate',
                        data);
                }, name: 'id',
            },
        ],
        'fnInitComplete': function () {
            $(document).on('change', '#statusArr', function () {
                $('#superAdminUsersTable').DataTable().ajax.reload(null, true);
            });
        },
    });
    handleSearchDatatable(tbl);
});

// $(document).on('click', '.show-btn', function (event) {
//     let userId = $(event.currentTarget).attr('data-id');
//     renderData(userId);
// });

$(document).on('click', '#resetFilter', function () {
    $('#statusArr').val('').trigger('change');
});

// window.renderData = function (id) {
//     $.ajax({
//         url: route('super.admin.users.show.modal', id),
//         type: 'GET',
//         success: function (result) {
//             if (result.success) {
//                 $('#first_name').text(result.data.first_name);
//                 $('#last_name').text(result.data.last_name);
//                 $('#username').text(result.data.username);
//                 $('#userEmail').text(result.data.email);
//                 $('#role').text(result.data.roles[0].name);
//                 $('#userPhone').text(result.data.phone ?? 'N/A');
//                 $('#userGender').text(result.data.gender_string);
//                 $('#userDob').text('');
//                 if (result.data.dob != null) $('#userDob').
//                     text(moment(result.data.dob).format('Mo MMM, YYYY'));
//                 $('#userStatus').empty();
//                 if (result.data.status == 1) {
//                     $('#userStatus').
//                         append(
//                             '<span class="badge badge-light-success">Active</span>');
//                 } else {
//                     $('#userStatus').
//                         append(
//                             '<span class="badge badge-light-danger">Deactive</span>');
//                 }
//                 $('#created_on').text(moment(result.data.created_at).fromNow());
//                 $('#updated_on').text(moment(result.data.updated_at).fromNow());
//                 $('#userProfilePicture').attr('src', result.data.image_url);
//
//                 setValueOfEmptySpan();
//                 $('#showUser').appendTo('body').modal('show');
//             }
//         },
//         error: function (result) {
//             displayErrorMessage(result.responseJSON.message);
//         },
//     });
// };

$(document).on('change', '.status', function (event) {
    let userId = $(event.currentTarget).data('id');
    updateStatus(userId);
});

window.updateStatus = function (id) {
    $.ajax({
        url: userUrl + '/' + id + '/active-deactive',
        method: 'post',
        cache: false,
        success: function (result) {
            if (result.success) {
                displaySuccessMessage(result.message);
                $('#superAdminUsersTable').DataTable().ajax.reload(null, false);
            }
        },
    });
};

$(document).on('change', '.is-verified', function (event) {
    let userId = $(event.currentTarget).data('id');
    $.ajax({
        url: userUrl + '/' + userId + '/is-verified',
        method: 'post',
        cache: false,
        success: function (result) {
            if (result.success) {
                displaySuccessMessage(result.message);
                $('#superAdminUsersTable').DataTable().ajax.reload(null, false);
            }
        },
    });
});

$(document).on('click', '.delete-btn', function (event) {
    let userId = $(event.currentTarget).data('id');
    deleteItem(hospitalUrl + '/' + userId, '#superAdminUsersTable', 'Hospital');
});
$(document).on('click', '.user-impersonate', function () {
    let id = $(this).data('id');

    let element = document.createElement('a');
    element.setAttribute('href', route('impersonate', id));
    document.body.appendChild(element);
    element.click();
    document.body.removeChild(element);
    $('.user-impersonate').prop('disabled', true);
});
