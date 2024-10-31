jQuery(document).ready(function ($) {

    function alignModal() {
        var modalDialog = $(this).find(".modal-dialog");
        /* Applying the top margin on modal dialog to align it vertically center */
        modalDialog.css("margin-top", Math.max(0, ($(window).height() - modalDialog.height()) / 2));
    }
    $(".sa-el-template-preview-import-modal").on("shown.bs.modal", alignModal);

    $(window).on("resize", function () {
        $(".sa-el-template-preview-import-modal:visible").each(alignModal);
    });
    $(window).load(function () {
        var height = $("#wpbody").height();
        $('.oxi-addons-sa-el-paren-loader').css('min-height', height + 'px');
    });
    var urlParams = new URLSearchParams(window.location.search);
    var type = urlParams.has('type') ? urlParams.get('type') : '';
    var section = urlParams.has('section') ? urlParams.get('section') : '';

    $(window).load(function () {
        var form_data = 'type=' + type + '&section=' + section;
        $.get(window.ElementorAddons.restapi + 'custom_templates/templates/0/', form_data, function (output) {
            setTimeout(function () {
                $("#oxi-addons-sa-el-parent").html(output);
            }, 1000);
        });
    });

    $(document).on("click", ".sa-el-preview-button", function (e) {
        e.preventDefault();
        var dataurl = $(this).attr('data-url');
        var datatitle = $(this).attr('sa-el-title');
        var IframeData = '<iframe id="sa-el-iframe-loader" src="' + dataurl + '">Your browser doesn\'t support iframes</iframe>';
        $("#SA-EL-IFRAME .modal-body").html(IframeData);
        $("#SA-EL-IFRAME #SA-el-ModalLabelTitle").html(datatitle);
        $("#SA-EL-IFRAME").modal();
        return false;
    });
    $("#SA-EL-IFRAME").on("hidden.bs.modal", function () {
        $("#sa-el-iframe-loader").remove();
    });
    $(document).on("click", ".sa-el-import-start", function (e) {
        e.preventDefault();
        var datatitle = $(this).attr('sa-el-title');
        var datasaelid = $(this).attr('sael-id');
        var required = require = $(this).attr('sael_required');
        $(".sa-el-reqired-plugins").remove();
        $("#sa-el-template-preview-import-modal .sa-el-final-import-start").attr("sa-elid", datasaelid);
        $("#sa-el-template-preview-import-modal .sa-el-final-create-start").attr("sa-elid", datasaelid);
        $("#sa-el-template-preview-import-modal .sa-el-final-import-start").attr("sael_required", '');
        $("#sa-el-template-preview-import-modal .sa-el-final-create-start").attr("sael_required", '');
        $("#sa-el-template-preview-import-modal h5.modal-title").html(datatitle);
        $("#sa-el-template-preview-import-modal .sa-el-final-import-start").html('Import ' + type.toUpperCase());
        $("#sa-el-template-preview-import-modal .sa-el-final-create-start").html('Create New Page');
        if (required !== '') {
            var res = required.split(",");
            var require = '<div class="sa-el-reqired-plugins"><p class="sa-el-msg"><span class="dashicons dashicons-admin-tools"></span> Required </p><ul class="required-plugins-list">';
            $.each(res, function (index, value) {
                if (value !== '') {
                    require += '<li class="sa-el-card">' + value.split("/")[0] + '</li>';
                }
            });
            require += '</ul><div>';
            $("#sa-el-template-preview-import-modal .sa-el-final-import-start").attr('sael_required', required);
            $("#sa-el-template-preview-import-modal .sa-el-final-create-start").attr('sael_required', required);
        }
        $("#sa-el-template-preview-import-modal .modal-body").before(require);
        $(".sa-el-final-edit-start").slideUp();
        $(".sa-el-page-edit").slideUp();
        $(".sa-el-final-import-start").slideDown();
        $(".sa-el-page-create").slideDown();
        $('#sa-el-page-name').val('');
        $("#sa-el-template-preview-import-modal").modal();
        return false;
    });

    $(".sa-el-final-edit-start").slideToggle();
    $(".sa-el-page-edit").slideToggle();
    $(document).on("click", ".sa-el-final-import-start", function (e) {
        var template_id = $(this).attr('sa-elid');
        var required = $(this).attr('sael_required');
        if (required !== '') {
            var res = required.split(",");
            var alertdata = 'For import this layouts kindly Install first ';
            $.each(res, function (index, value) {
                if (value !== '') {
                    alertdata += value.split("/")[0] + ', ';
                }
            });
            alert(alertdata);
            e.preventDefault();
            return false;
        } else {
            $(".sa-el-final-import-start").html('Importing...');
            $.ajax({
                url: saelemetoraddons.ajaxurl,
                type: "post",
                data: {
                    action: 'saeladdons_custom_templates',
                    _wpnonce: saelemetoraddons.nonce,
                    template_id: template_id,
                    with_page: '',
                },
                success: function (response) {
                    if (response === 'problem') {
                        alert('Error Data :( Kindly contact to Elementor Addons');
                    } else {
                        $(".sa-el-final-import-start").slideToggle();
                        $(".sa-el-final-edit-start").attr('href', $(".sa-el-final-edit-start").attr('data-hr') + response + '&action=elementor');
                        $(".sa-el-final-edit-start").slideToggle();
                    }
                }
            });
            e.preventDefault();
            return false;
        }
    });
    $(document).on("click", ".sa-el-final-create-start", function (e) {
        var template_id = $(this).attr('sa-elid');
        var required = $(this).attr('sael_required');
        if (required !== '') {
            var res = required.split(",");
            var alertdata = 'For import this layouts kindly Install first ';
            $.each(res, function (index, value) {
                if (value !== '') {
                    alertdata += value.split("/")[0] + ', ';
                }
            });
            alert(alertdata);
            e.preventDefault();
            return false;
        } else {
            var with_page = $('#sa-el-page-name').val();
            if (with_page === '') {
                alert('kindly Add Page Title');
                e.preventDefault();
                return false;
            }
            $(".sa-el-final-create-start").html('Creating...');
            $('#sa-el-page-name').val('');
            $.ajax({
                url: saelemetoraddons.ajaxurl,
                type: "post",
                data: {
                    action: 'saeladdons_custom_templates',
                    _wpnonce: saelemetoraddons.nonce,
                    template_id: template_id,
                    with_page: with_page,
                },
                success: function (response) {
                    if (response === 'problem') {
                        alert('Error Data :( Kindly contact to Elementor Addons');
                    } else {
                        $(".sa-el-final-edit-page").attr('href', $(".sa-el-final-edit-page").attr('data-hr') + response + '&action=elementor');
                        $(".sa-el-page-create").slideToggle();
                        $(".sa-el-page-edit").slideToggle();
                    }
                }
            });
            e.preventDefault();
            return false;
        }
    });


});