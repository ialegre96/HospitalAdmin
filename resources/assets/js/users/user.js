'use strict';

$(document).ready(function () {
    let tableName = '#usersTable';
    let tbl = $(tableName).DataTable({
        searchDelay: 500,
        processing: true,
        serverSide: true,
        'language': {
            'lengthMenu': 'Show _MENU_',
        },
        'order': [[5, 'desc']],
        ajax: {
            url: userUrl,
            data: function (data) {
                data.department_id = $('#roleArr').
                    find('option:selected').
                    val();
                data.status = $('#statusArr').find('option:selected').val();
            },
        },
        columnDefs: [
            {
                'targets': [1],
                'orderable': false,
            },
            {
                'targets': [2, 3],
                'className': 'text-center',
                'orderable': false,
            },
            {
                'targets': [3],
                'orderable': false,
            },
            {
                'targets': [4],
                'className': 'text-center text-nowrap',
                'orderable': false,
            },
            {
                'targets': [5],
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
                    let showLink = userShowUrl + '/' + row.id;
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
                                <a href="#" class="mb-1 show-btn" data-id="${row.id}">${row.full_name}</a>
                                <span>${row.email}</span>
                            </div>
                    </div>`;
                },
                name: 'first_name',
            },
            {
                data: 'department.name',
                name: 'department.name',
            },
            {
                data: function (row){
                    let checked = row.email_verified_at == null ? '' : 'checked disabled';
                    if (row.department && row.department.name != 'Admin') {
                        return `<label class="form-check form-switch form-check-custom form-check-solid form-switch-sm justify-content-center">
                                 <input name="status" data-id="${row.id}" class="form-check-input is-verified" type="checkbox" value="1" ${checked}>
                                  <span class="switch-slider" data-checked="&#x2713;" data-unchecked="&#x2715;"></span>
                            </label>`;
                    }
                },
                name: 'department.name',
            },
            {
                data: function (row) {
                    if (row.department && row.department.name != 'Admin') {
                        let checked = row.status == 0 ? '' : 'checked';
                        let data = [{'id': row.id, 'checked': checked}];
                        return prepareTemplateRender('#userStatusTemplate', data);
                    }
                },
                name: 'status',
            },
            {
                data: function (row) {
                    let url = userUrl + '/' + row.id;
                    let data = [
                        {
                            'id': row.id,
                            'url': url + '/edit',
                            'role': row.department && row.department.name,
                        }];
                    return prepareTemplateRender('#userActionTemplate', data);
                },
                name: 'last_name',
            },
            {
                data: 'created_at',
                name: 'created_at',
            },
        ],
        'fnInitComplete': function () {
            $(document).on('change', '#roleArr, #statusArr', function () {
                $('#usersTable').DataTable().ajax.reload(null, true);
            });
        },
    });
    handleSearchDatatable(tbl);
});

$(document).on('click', '.delete-btn', function (event) {
    let userId = $(event.currentTarget).data('id');
    deleteItem(userUrl + '/' + userId, '#usersTable', 'User');
});

$(document).on('click', '#resetFilter', function () {
    $('#roleArr').val('').trigger('change');
    $('#statusArr').val('').trigger('change');
});

$(document).on('change', '.status', function (event) {
    let userId = $(event.currentTarget).data('id');
    updateStatus(userId);
});

$(document).on('click', '.show-btn', function (event) {
    let userId = $(event.currentTarget).attr('data-id');
    renderData(userId);
});

window.renderData = function (id) {
    $.ajax({
        url: route('users.show.modal', id),
        type: 'GET',
        success: function (result) {
            if (result.success) {
                $('#first_name').text(result.data.first_name);
                $('#last_name').text(result.data.last_name);
                $('#userEmail').text(result.data.email);
                $('#role').text(result.data.roles[0].name);
                $('#userPhone').text(result.data.phone ?? 'N/A');
                $('#userGender').text(result.data.gender_string);
                $('#userDob').text('');
                if(result.data.dob != null) $('#userDob').text(moment(result.data.dob).format('Mo MMM, YYYY'));
                $('#userStatus').empty();
                if (result.data.status == 1) {
                    $('#userStatus').
                        append(
                            '<span class="badge badge-light-success">Active</span>');
                } else {
                    $('#userStatus').
                        append(
                            '<span class="badge badge-light-danger">Deactive</span>');
                }
                $('#created_on').text(moment(result.data.created_at).fromNow());
                $('#updated_on').text(moment(result.data.updated_at).fromNow());
                $('#userProfilePicture').attr('src', result.data.image_url);

                setValueOfEmptySpan();
                $('#showUser').appendTo('body').modal('show');
            }
        },
        error: function (result) {
            displayErrorMessage(result.responseJSON.message);
        },
    });
};

window.updateStatus = function (id) {
    $.ajax({
        url: userUrl + '/' + id + '/active-deactive',
        method: 'post',
        cache: false,
        success: function (result) {
            if (result.success) {
                displaySuccessMessage(result.message);
                $('#usersTable').DataTable().ajax.reload(null, false);
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
                $('#usersTable').DataTable().ajax.reload(null, false);
            }
        },
    });
});
