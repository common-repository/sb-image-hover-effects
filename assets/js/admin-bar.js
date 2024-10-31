(function ($) {
    "use strict";
    $(document).on('click', '.sa-el-clear-cache', function (e) {
        e.preventDefault();
        if (typeof sa_el_addons_loader !== 'undefined' && sa_el_addons_loader) {
            var $settings = $(this).find('.sa-el-clear-cache-id').data('pageid');
            var text = $(this).find('.ab-item');
            var $class = $(this).find('.sa-el-clear-cache-id').data('class');
            var $optional = 'single';
            var $function = 'addons_page_cache';
            $.ajax({
                url: sa_el_addons_loader.ajaxurl,
                type: "post",
                data: {
                    action: "sa_el_addons_loader",
                    _wpnonce: sa_el_addons_loader.nonce,
                    class: $class,
                    function: $function,
                    args: '',
                    settings: $settings,
                    optional: $optional
                },
                beforeSend: function () {
                    text.text(
                            'Clearing...'
                            );
                },
                success: function (response) {
                    console.log(response);
                    setTimeout(function () {
                        text.text('Clear Page Cache');
                        window.location.reload();
                    }, 1000);
                },
                error: function () {
                    console.log('Something went wrong!');
                }
            });
        } else {
            console.log('This page has no widget from Elementor');
        }
    });
    $(document).on('click', '.sa-el-all-cache-clear', function (e) {
        e.preventDefault();
        if (typeof sa_el_addons_loader != 'undefined' && sa_el_addons_loader) {
            var $settings = '';
            var text = $(this).find('.ab-item');
            var $class = $(this).find('.sa-el-all-cache-clear-child').data('class');
            var $optional = 'clear_all';
            var $function = 'addons_page_cache';
            $.ajax({
                url: sa_el_addons_loader.ajaxurl,
                type: "post",
                data: {
                    action: "sa_el_addons_loader",
                    _wpnonce: sa_el_addons_loader.nonce,
                    class: $class,
                    function: $function,
                    args: '',
                    settings: $settings,
                    optional: $optional
                },
                beforeSend: function () {
                    text.text(
                            'Clearing...'
                            );
                },
                success: function (response) {
                    console.log(response);
                    setTimeout(function () {
                        text.text('Clear All Cache');
                        window.location.reload();
                    }, 1000);
                },
                error: function () {
                    console.log('Something went wrong!');
                }
            });
        } else {
            console.log('This page has no widget from Elementor Addons, Clear cache from Dashboard');
        }
    });
})(jQuery);
