define([
    'jquery',
    'mage/translate',
    'Magento_Ui/js/model/messageList',
    'Magento_Ui/js/view/messages', 
    'mage/loader'
], function ($, $t, messageList, messages) {
    'use strict';

    return function () {
        $(document).ready(function () {

            $('#cancel-order-btn').on('click', function () {
                $('#cancel-order-popup').fadeIn();
            });

            $('.mavenbird-close-popup').on('click', function () {
                $('#cancel-order-popup').fadeOut();
            });

            $('#cancel-reason-select').on('change', function () {
                if ($(this).val() === 'Other') {
                    $('#cancel-reason-other-box').slideDown();
                    $('#cancel-reason-other').prop('required', true);
                } else {
                    $('#cancel-reason-other-box').slideUp();
                    $('#cancel-reason-other').prop('required', false).val('');
                }
            });

            //  Submit cancel request
            $('#submit-cancel-order').on('click', function () {
                var orderId = $('#cancel-order-btn').data('order-id'),
                    reason = $('#cancel-reason-select').val();

                if (reason === 'Other') {
                    reason = $('#cancel-reason-other').val();
                }

                if (!reason) {
                    messageList.addErrorMessage({ message: $t('Please provide a reason.') });
                    return;
                }

                $.ajax({
                    url: '/cancelorder/order/cancel',
                    type: 'POST',
                    dataType: 'json',
                    data: { order_id: orderId, reason: reason },
                    showLoader: true,
                    success: function (response) {
                        if (response.success) {
                            messageList.addSuccessMessage({ message: response.message });
                            location.reload();
                        } else {
                            messageList.addErrorMessage({ message: response.message });
                        }
                    },
                    error: function () {
                        messageList.addErrorMessage({
                            message: $t('Something went wrong. Please try again.')
                        });
                    }
                });
            });

        });
    };
});
