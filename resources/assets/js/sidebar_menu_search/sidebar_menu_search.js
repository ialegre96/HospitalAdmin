'use strict';

// $(document).ready(function () {
//     var $block = $('.no-results');
//
//     $('#searchText').on('keyup', function () {
//         let searchText = $(this).val();
//         var isMatch = false;
//
//         let value = this.value.toLowerCase().trim();
//         $(document).on('click','.close-sign',function () {
//             $('#searchText').val('');
//             $('.side-menus').show().filter(function () {
//                 if (searchText != '') {
//                     $(this).removeClass('open');
//                 }
//             });
//             $('.close-sign').hide();
//             $('.no-results').css('display', 'none');
//         });
//
//         $('.side-menus').show().filter(function () {
//             $(this).addClass('open');
//             if (searchText == '') {
//                 $(this).removeClass('open');
//                 $('.close-sign').hide();
//             }
//             if ($(this).text().toLowerCase().trim().indexOf(value) == -1) {
//                 $(this).hide();
//                 $('.close-sign').show();
//             } else {
//                 isMatch = true;
//                 $(this).show();
//             }
//         });
//         $block.toggle(!isMatch);
//     });
// });

$(document).ready(function () {
    $('#menuSearch').on('keyup', function () {
        let value = $(this).val().toLowerCase();
        $('.menu-item').filter(function () {
            $('.no-record').addClass('d-none');
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
            checkEmpty();
        });
    });

    function checkEmpty () {
        if ($('.menu-item:visible').last().length == 0) {
            $('.no-record').removeClass('d-none');
        }
    }
    
    $(document).on('click', '.sidebar-aside-toggle', function (){
        if($(this).hasClass('active') === true){
            $('.sidebar-search-box').addClass('d-none');
        }else{
            $('.sidebar-search-box').removeClass('d-none');
        }
    });
});
