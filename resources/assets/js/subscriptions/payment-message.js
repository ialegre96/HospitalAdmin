'use strict';
window.paymentMessage = function (data = null) {
    toastData = data != null ? data : toastData;
    if (toastData !== null) {
        setTimeout(function () {
            $.toast({
                heading: toastData.toastType,
                icon: toastData.toastType,
                bgColor: '#7603f3',
                textColor: '#ffffff',
                text: toastData.toastMessage,
                position: 'top-right',
                stack: false,
            });
        }, 1000);
    }
};
paymentMessage();
