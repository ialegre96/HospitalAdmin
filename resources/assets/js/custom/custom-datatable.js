'use strict';

window.handleSearchDatatable = (tbl) => {
    const filterSearch = document.querySelector('[data-datatable-filter="search"]');
    filterSearch.addEventListener('keyup', function (e) {
        tbl.search(e.target.value).draw();
    });
    filterSearch.addEventListener('search', function (e) {
        tbl.search(e.target.value).draw();
    });
}

$.extend($.fn.dataTable.defaults, {
    'paging': true,
    'info': true,
    'ordering': true,
    'autoWidth': false,
    'pageLength': 10,
    'language': {
        'search': '',
        'sSearch': 'Search',
    },
    "preDrawCallback": function () {
        customSearch()
    }
});

function customSearch() {
    $('.dataTables_filter input').addClass("form-control");
    $('.dataTables_filter input').attr("placeholder", "Search");
}

