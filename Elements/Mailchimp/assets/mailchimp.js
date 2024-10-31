(function($) {
    'use strict';
    window.sa_el_mailchimp_subscribe = function(formId, listId, buttonText, successMsg, loadingText, classs, functions) {
        $('#' + formId).on('submit', function(e) {
            e.preventDefault();
            var self = $(this);
            var args = self.serialize();
            self.find('.sa-el-mailchimp-subscribe').addClass('button--loading');
            self.find('.sa-el-mailchimp-subscribe span').html(loadingText);
            $.ajax({
                url: sa_el_addons_loader.ajaxurl,
                type: "post",
                data: {
                    action: "sa_el_addons_loader",
                    _wpnonce: sa_el_addons_loader.nonce,
                    class: classs,
                    function: functions,
                    args: args,
                    settings: listId,
                },

                success: function(data) {
                    if (data != 'error') {
                        self.find('.sa-el-mailchimp-fields-wrapper').after('<div class="sa-el-mailchimp-message"><p>' + successMsg + '</p></div>');
                        self.find('input[type=text], input[type=email], textarea').val('');
                        self.find('.sa-el-mailchimp-subscribe').removeClass('button--loading');
                        self.find('.sa-el-mailchimp-subscribe span').html(buttonText);
                    } else {
                        self.find('.sa-el-mailchimp-fields-wrapper').after('<div class="sa-el-mailchimp-message"><p>Something goes wrong, Try again later.</p></div>');
                        self.find('.sa-el-mailchimp-subscribe').removeClass('button--loading');
                        self.find('.sa-el-mailchimp-subscribe span').html(buttonText);
                    }
                }
            });
        });
    };

})(jQuery);