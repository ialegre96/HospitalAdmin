function initTheme () {
    const darkThemeSelected =
        localStorage.getItem('darkSwitch') !== null &&
        localStorage.getItem('darkSwitch') === 'dark';
    darkSwitch.checked = darkThemeSelected;
    darkThemeSelected ? document.body.setAttribute('data-theme', 'dark') :
        document.body.removeAttribute('data-theme');
}

function resetTheme () {
    if (darkSwitch.checked) {
        document.body.setAttribute('data-theme', 'dark');
        localStorage.setItem('darkSwitch', 'dark');
    } else {
        document.body.removeAttribute('data-theme');
        localStorage.removeItem('darkSwitch');
    }
}

// dark mode by https://github.com/coliff/dark-mode-switch
const darkSwitch = document.getElementById('darkSwitch');

// this is here so we can get the body dark mode before the page displays
// otherwise the page will be white for a second... 
initTheme();

window.addEventListener('load', () => {
    if (darkSwitch) {
        initTheme();
        darkSwitch.addEventListener('change', () => {
            resetTheme();
        });
    }
});

// end darkmode js

$(document).ready(function () {
    $('.table-container tr').on('click', function () {
        $('#' + $(this).data('display')).toggle();
    });
    $('#table-log').DataTable({
        'order': [$('#table-log').data('orderingIndex'), 'desc'],
        'stateSave': true,
        'stateSaveCallback': function (settings, data) {
            window.localStorage.setItem('datatable', JSON.stringify(data));
        },
        'stateLoadCallback': function (settings) {
            var data = JSON.parse(window.localStorage.getItem('datatable'));
            if (data) data.start = 0;
            return data;
        },
    });
    $(document).
        on('click', '#delete-log, #clean-log, #delete-all-log', function () {
            return confirm('Are you sure?');
        });
});
