jQuery(document).ready(function ($) {
    "use strict";
    $('.row-actions .edit a, .page-title-action, .column-title .row-title').on('click', function (e) {
        e.preventDefault();
        var id = 0;
        var modal = $('#addons_headerfooter_modal');
        var parent = $(this).parents('.column-title');

        modal.addClass('loading');
        modal.modal('show');
        if (parent.length > 0) {
            id = parent.find('.hidden').attr('id').split('_')[1];
            $.get(window.ElementorAddons.restapi + 'template/get/' + id, function (data) {
                Elementor_Addons_Template_Editor(data);
                modal.removeClass('loading');
            });
        } else {
            var data = {
                title: '',
                type: 'header',
                cond_a: 'entire_site',
                cond_singular: 'all',
                activation: '',
            };
            Elementor_Addons_Template_Editor(data);
            modal.removeClass('loading');
        }

        modal.find('form').attr('data-addons-id', id);
    });

    $('.addons_condition_a').on('change', function () {
        var condition_a = $(this).val();
        var inputs = $('.addons_condition_singular-container');
        if (condition_a == 'singular') {
            inputs.show();
        } else {
            inputs.hide();
        }
    });

    $('.addons_condition_singular').on('change', function () {
        var condition_singular = $(this).val();
        var inputs = $('.addons_condition_singular_id-container');
        if (condition_singular == 'selected') {
            inputs.show();
        } else {
            inputs.hide();
        }
    });


    $('.addons-save-btn-editor').on('click', function () {
        var form = $('#addons_modalinput-form');
        form.attr('data-open-editor', '1');
        form.trigger('submit');
    });

    $('#addons_modalinput-form').on('submit', function (e) {
        e.preventDefault();
        var modal = $('#addons_headerfooter_modal');
        modal.addClass('loading');
        var form_data = $(this).serialize();
        var id = $(this).attr('data-addons-id');
        var open_editor = $(this).attr('data-open-editor');
        var admin_url = $(this).attr('data-editor-url');
        $.get(window.ElementorAddons.restapi + 'template/update/' + id, form_data, function (output) {
            modal.removeClass('loading');
            var row = $('#post-' + output.data.id);
            if (row.length > 0) {
                console.log(output);
                row.find('.column-type')
                        .html(output.data.type_html);

                row.find('.column-condition')
                        .html(output.data.cond_text);

                row.find('.row-title')
                        .html(output.data.title)
                        .attr('aria-label', output.data.title);
            }
            if (open_editor == '1') {
                window.location.href = admin_url + '?post=' + output.data.id + '&action=elementor';
            } else if (id == '0') {
                location.reload();
            }
        });

    });

    $('.addons_condition_singular_id').select2({
        ajax: {
            url: window.ElementorAddons.restapi + 'template/singular_list/0/',
            dataType: 'json',
            data: function (params) {
                var query = {
                    qu: params.term
                }
                return query;
            }
        },
        width: '100%',
        cache: true,
        placeholder: "--",
    });

    function Elementor_Addons_Template_Editor(data) {
       
        $('.addons-modalinput-title').val(data.title);
        $('.addons_condition_type').val(data.type);
        $('.addons_condition_a').val(data.cond_a);
        $('.addons_condition_singular').val(data.cond_singular);
        $('.addons_condition_singular_id').val(data.cond_singular_id);
        var activation_input = $('.addons-modalinput-activition');
        if (data.activation == 'yes') {
            activation_input.attr('checked', true);
        } else {
            activation_input.removeAttr('checked');
        }

        $('.addons-modalinput-activition, .addons-modalinput-type, .addons_condition_a, .addons_condition_singular').trigger('change');

        var el = $('.addons_condition_singular_id');
        $.ajax({
            url: window.ElementorAddons.restapi + 'template/singular_list/0/',
            dataType: 'json',
            data: {
                ids: String(data.cond_singular_id)
            }
        }).then(function (data) {

            if (data !== null && data.results.length > 0) {
                el.html(' ');
                $.each(data.results, function (i, v) {
                    var option = new Option(v.text, v.id, true, true);
                    el.append(option).trigger('change');
                });
                el.trigger({
                    type: 'select2:select',
                    params: {
                        data: data
                    }
                });
            }
        });
    }
    function url_replace_param(url, paramName, paramValue) {
        if (paramValue == null) {
            paramValue = '';
        }
        var pattern = new RegExp('\\b(' + paramName + '=).*?(&|#|$)');
        if (url.search(pattern) >= 0) {
            return url.replace(pattern, '$1' + paramValue + '$2');
        }
        url = url.replace(/[?#]$/, '');
        return url + (url.indexOf('?') > 0 ? '&' : '?') + paramName + '=' + paramValue;
    }

    var tab_container = $('.wp-header-end');
    var tabs = '';
    var xs_types = {
        'all': 'All',
        'header': 'Header',
        'footer': 'Footer',
    };
    var url = new URL(window.location.href);
    var s = url.searchParams.get("addons_type_filter");
    s = (s == null) ? 'all' : s;

    $.each(xs_types, function (k, v) {
        var url = url_replace_param(window.location.href, 'addons_type_filter', k);
        var klass = (s == k) ? 'addons_type_filter_active nav-tab-active' : ' ';
        tabs += `
            <a href="${url}" class="${klass} addons_type_filter_tab_item nav-tab">${v}</a>
        `;
        tabs += "\n";
    });
    tab_container.after('<div class="addons_type_filter_tab_container nav-tab-wrapper">' + tabs + '</div><br/>');
});