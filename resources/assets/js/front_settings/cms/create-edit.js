'use strict';

$(document).ready(function () {

    $(document).on('change', '#homePageImage', function () {
        let extension = isValidImage($(this), '#validationErrorsBox');
        if (!isEmpty(extension) && extension != false) {
            $('#validationErrorsBox').html('').hide();
            displayDocument(this, '#previewImage', extension);
        }
    });

    window.isValidImage = function (inputSelector, validationMessageSelector) {
        let ext = $(inputSelector).val().split('.').pop().toLowerCase();
        if ($.inArray(ext, ['jpg', 'png', 'jpeg']) == -1) {
            $(inputSelector).val('');
            $(validationMessageSelector).removeClass('d-none');
            $(validationMessageSelector).
                html('The image must be a file of type: jpg, jpeg, png.').
                show();
            return false;
        }
        $(validationMessageSelector).hide();
        return true;
    };

    if (typeof termConditionPrivacyPolicy != 'undefined' &&
        termConditionPrivacyPolicy == true) {
        let quill1 = new Quill('#termConditionId', {
            modules: {
                toolbar: [
                    [
                        {
                            header: [1, 2, false],
                        }],
                    ['bold', 'italic', 'underline'],
                    ['image', 'code-block'],
                ],
            },
            placeholder: 'Terms & Conditions',
            theme: 'snow', // or 'bubble'
        });
        quill1.on('text-change', function (delta, oldDelta, source) {
            if (quill1.getText().trim().length === 0) {
                quill1.setContents([{ insert: '' }]);
            }
        });

        let quill2 = new Quill('#privacyPolicyId', {
            modules: {
                toolbar: [
                    [
                        {
                            header: [1, 2, false],
                        }],
                    ['bold', 'italic', 'underline'],
                    ['image', 'code-block'],
                ],
            },
            placeholder: 'Privacy Policy',
            theme: 'snow', // or 'bubble'
        });
        quill2.on('text-change', function (delta, oldDelta, source) {
            if (quill2.getText().trim().length === 0) {
                quill2.setContents([{ insert: '' }]);
            }
        });

        let element = document.createElement('textarea');
        element.innerHTML = termConditionData;
        quill1.root.innerHTML = element.value;

        element.innerHTML = privacyPolicyData;
        quill2.root.innerHTML = element.value;

        $(document).on('submit', '#termsAndCondition', function () {
            let element = document.createElement('textarea');
            let editor_content_1 = quill1.root.innerHTML;
            element.innerHTML = editor_content_1;
            let editor_content_2 = quill2.root.innerHTML;

            if (quill1.getText().trim().length === 0) {
                displayErrorMessage('The Terms & Conditions is required.');
                return false;
            }

            if (quill2.getText().trim().length === 0) {
                displayErrorMessage('The Privacy Policy is required.');
                return false;
            }

            $('#termData').val(JSON.stringify(editor_content_1));
            $('#privacyData').val(JSON.stringify(editor_content_2));
        });
    }

    $(document).on('submit', '#addCMSForm', function () {
        let title = $('#homeTitleId').val();
        let empty = title.trim().replace(/ \r\n\t/g, '') === '';

        if (empty) {
            displayErrorMessage(
                'Home Page Title field is not contain only white space');
            return false;
        }
    });
});
