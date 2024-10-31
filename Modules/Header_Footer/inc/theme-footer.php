<?php do_action('ElementorAddons/template/before_footer'); ?>
<div class="elementor-addons-template-content-markup elementor-addons-template-content-footer elementor-addons-template-content-theme-support">
    <?php
    $CLASS = \SA_EL_ADDONS\Modules\Header_Footer\Header_Footer::instance();
    $template = $CLASS->template_ids();
    echo $CLASS->elementor_content($template[1]);
    ?>
</div>
<?php do_action('ElementorAddons/template/after_footer'); ?>
<?php wp_footer(); ?>

</body>
</html>
