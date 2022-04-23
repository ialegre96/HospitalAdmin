'use strict';

$(document).ready(function () {
    getIpdTimelines(ipdPatientDepartmentId);
});

window.getIpdTimelines = function (ipdPatientDepartmentId) {
    $.ajax({
        url: ipdTimelinesUrl,
        type: 'get',
        data: { id: ipdPatientDepartmentId },
        success: function (data) {
            $('#ipdTimelines').html(data);
        },
    });
};
