jQuery(document).ready(function ($) {
    $('.oxi-addons-switcher-btn').on('change', function (e) {
        $('.sa-el-header-right .sa-el-settings-save').removeAttr("disabled").removeAttr("sa-el-change").css('cursor', 'pointer').html('Save Settings');
    });
    $('.sa-el-header-right .sa-el-settings-save').on('click', function (e) {
        e.preventDefault();
        var elements = $("form#sa-el-settings").serialize();
        if ($(this).is("[sa-el-change]")) {
            $('.sa-el-header-right .sa-el-settings-save').html('Save Settings');
            $('.sa-el-header-right .sa-el-settings-save').attr("disabled", "disabled").css('cursor', 'not-allowed');
        } else {
            jQuery.post({
                url: saelemetoraddons.ajaxurl,
                beforeSend: function () {
                    $('.sa-el-header-right .sa-el-settings-save').html('<span class="dashicons dashicons-admin-generic"></span> saving data');
                },
                data: {
                    action: 'saelemetoraddons_settings',
                    _wpnonce: saelemetoraddons.nonce,
                    functionname: 'addons_settings',
                    rawdata: elements,
                    satype: ''
                },
                success: function (data) {
                    $('.sa-el-header-right .sa-el-settings-save').attr("sa-el-change", "no");
                    $('.sa-el-header-right .sa-el-settings-save').html('saved &#128522;');
                    $('#OXIAADDONSCHANGEDPOPUP .icon-box').html('<span class="dashicons dashicons-yes"></span>');
                    $('#OXIAADDONSCHANGEDPOPUP .modal-body.text-center h4').html('Great!');
                    $('#OXIAADDONSCHANGEDPOPUP .modal-body.text-center p').html('Select elements has been saved successfully.');
                    $('#OXIAADDONSCHANGEDPOPUP').modal('show');
                    OXIAADDONSCHANGEDPOPUP();
                }
            });
        }
        return false;
    })
    $('.sa-el-admin-block-content .sa-el-button-clear-cache').on('click', function (e) {
        e.preventDefault();
        jQuery.post({
            url: saelemetoraddons.ajaxurl,
            beforeSend: function () {
                $('.sa-el-admin-block-content .sa-el-button-clear-cache').html('<span class="dashicons dashicons-admin-generic"></span> Deleting');
            },
            data: {
                action: 'saelemetoraddons_settings',
                _wpnonce: saelemetoraddons.nonce,
                functionname: 'addons_cache',
                rawdata: "elements",
                satype: ''
            },
            success: function (data) {
                console.log(data);
                $('.sa-el-admin-block-content .sa-el-button-clear-cache').html('Complete &#128522;');
                $('#OXIAADDONSCHANGEDPOPUP .icon-box').html('<span class="dashicons dashicons-yes"></span>');
                $('#OXIAADDONSCHANGEDPOPUP .modal-body.text-center h4').html('Great!');
                $('#OXIAADDONSCHANGEDPOPUP .modal-body.text-center p').html('Cache has been delete successfully.');
                $('#OXIAADDONSCHANGEDPOPUP').modal('show');
                OXIAADDONSCHANGEDPOPUP();
            }
        });
        return false;
    })



    function OXIAADDONSCHANGEDPOPUP() {
        if (($("#OXIAADDONSCHANGEDPOPUP").data('bs.modal') || {})._isShown) {
            setTimeout(function () {
                $('#OXIAADDONSCHANGEDPOPUP').modal('hide');
            }, 3000);
        }
    }

    $('.sa-el-btn-group .sa-el-btn-control-enable').on('click', function (e) {
        e.preventDefault();
        $("#tabs-elements .oxi-sa-cards .oxi-sa-cards-switcher input:enabled").each(
                function (i) {
                    $(this)
                            .prop("checked", true)
                            .change();
                }
        );
    });
    $('.dashicons-sa-el-icon-link').on('click', function (e) {
        e.preventDefault();
        var href = $(this).data('href');
        window.open('' + href + '', '_blank');
    });
    $(".oxi-sa-cards-switcher-disabled").each(function (i) {
        $(this).children('input').attr("disabled", "disabled");
    });
    $(".oxi-sa-cards-switcher-disabled").on('click', function (e) {
        e.preventDefault();
        $('#OXIAADDONSCHANGEDPOPUP .icon-box').html('<span class="dashicons dashicons-shield-alt"></span>');
        $('#OXIAADDONSCHANGEDPOPUP .modal-body.text-center h4').html('Go Premium');
        $('#OXIAADDONSCHANGEDPOPUP .modal-body.text-center p').html('Purchase our <a href="https://www.oxilab.org/downloads/elementor-addons/" target="_blank">premium version</a> to unlock these pro components!');
        $('#OXIAADDONSCHANGEDPOPUP').modal('show');
    });
    $('.sa-el-btn-group .sa-el-btn-control-disable').on('click', function (e) {
        e.preventDefault();
        $("#tabs-elements .oxi-sa-cards .oxi-sa-cards-switcher input:enabled").each(
                function (i) {
                    $(this)
                            .prop("checked", false)
                            .change();
                }
        );
    });
    var fristtabs = '#tabs-elements';
    var hash = window.location.hash;
    fristtabs = (hash !== '' ? hash : fristtabs);
    $(".ctu-ulimate-style-2 .vc-tabs-li[ref='" + fristtabs + "']").addClass("active");
    $(".ctu-ulitate-style-2-tabs" + fristtabs).css("display", "block");
    $(".ctu-ulimate-style-2 .vc-tabs-li").click(function () {
        if ($(this).hasClass("active")) {
            return false;
        } else {
            $(".ctu-ulimate-style-2 .vc-tabs-li").removeClass("active");
            $(this).toggleClass("active");
            $(".ctu-ulitate-style-2-tabs").css("display", "none");
            var activeTab = $(this).attr("ref");
            $(activeTab).css("display", "block");
        }
    });
    $(".oxi-addons-ce-heading").click(function () {
        $(this).parent().toggleClass('oxi-sa-cards-hidden');
    });
    $('.oxi-sa-cards-settings .dashicons-modal-settings').on('click', function (e) {
        e.preventDefault();
        var D = $(this).data('encode');
        var value = $(this).data('savl');
        var store = '';
        $.each(D, function (a, b) {
            if (b.type === 'select') {
                store += '<div class="form-group w-100">';
                store += '<label for="' + a + '">' + b.name + '</label>';
                store += '<select class="form-control" id="' + a + '"  name="' + a + '">';
                $.each(b.options, function (x, y) {
                    store += '<option value="' + x + '" ' + (value[a] === x ? 'selected' : '') + '>' + y + '</option>';
                });
                store += '</select>';
                store += '</div>';
            } else {
                store += '<div class="form-group w-100">';
                store += '<label for="' + a + '">' + b.name + '</label>';
                store += '<input type="text" class="form-control" id="' + a + '"  name="' + a + '" value="' + value[a] + '" placeholder="' + b.placeholder + '">';
                store += '</div>';
            }
        });
        $('#sa-el-modal-settings  .modal-title').html($(this).data('title') + ' Settings');
        $('#sa-el-modal-settings  .modal-body').html(store);
        $('#sa-el-addons-modal-settings .btn.btn-primary').data('target', $(this).attr('id'));
        $('#sa-el-modal-settings .btn.btn-primary').html('Saved');
        $('#sa-el-addons-modal-settings').modal('show');
    });
    $('#sa-el-modal-settings .btn.btn-primary').on('click', function (e) {
        e.preventDefault();
        var elements = $("form#sa-el-modal-settings").serialize();
        $This = $(this);
        jQuery.post({
            url: saelemetoraddons.ajaxurl,
            beforeSend: function () {
                $('#sa-el-modal-settings .btn.btn-primary').html('Saving');
            },
            data: {
                action: 'saelemetoraddons_settings',
                _wpnonce: saelemetoraddons.nonce,
                functionname: 'modal_settings',
                rawdata: elements,
                satype: ''
            },
            success: function (d) {
                object = $.parseJSON(d);
                $('#sa-el-modal-settings  .modal-body').html('');
                console.log($('#'+$This.data('target')));
                $('#'+$This.data('target')).data('savl', object);
                $('#sa-el-addons-modal-settings').modal('hide');
            }
        });

        return false;
    })


}
);