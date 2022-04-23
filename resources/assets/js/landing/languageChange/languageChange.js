
$(document).ready(function (){
    $(document).on('click','.languageSelection',function (){
        let changeLanguageName = $(this).attr('data-prefix-value');
        $.ajax({
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            type: 'POST',
            url: '/language-change-name',
            data: { languageName: changeLanguageName },
            success: function () {
                location.reload();
            },
        });
    })
})
