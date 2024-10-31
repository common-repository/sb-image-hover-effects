<?php

namespace SA_EL_ADDONS\Modules\Header_Footer\Theme;

defined('ABSPATH') || exit;

class Bbtheme {

    private $elementor;
    private $header;
    private $footer;

    function __construct($template_ids) {
        $this->header = $template_ids[0];
        $this->footer = $template_ids[1];

        if (defined('ELEMENTOR_VERSION') && is_callable('Elementor\Plugin::instance')) {
            $this->elementor = \Elementor\Plugin::instance();
        }

        if ($this->header != null) {
            add_filter('fl_header_enabled', '__return_false');
            add_action('fl_before_header', [$this, 'add_plugin_header_markup']);
        }

        if ($this->footer != null) {
            add_filter('fl_footer_enabled', '__return_false');
            add_action('fl_after_content', [$this, 'add_plugin_footer_markup']);
        }
    }

    public function add_plugin_header_markup() {
        $header_layout = FLTheme::get_setting('fl-header-layout');

        if ('none' == $header_layout || is_page_template('tpl-no-header-footer.php')) {
            return;
        }

        do_action('ElementorAddons/template/before_header');
        ?>
        <header id="masthead" itemscope="itemscope" itemtype="https://schema.org/WPHeader">
            <div class="elementor-addons-template-content-markup elementor-addons-template-content-header">
                <p class="main-title bhf-hidden" itemprop="headline">
                    <a href="<?php echo bloginfo('url'); ?>"title="<?php echo esc_attr(get_bloginfo('name', 'display')); ?>"  rel="home"><?php bloginfo('name'); ?></a></p>
                <?php echo \SA_EL_ADDONS\Modules\Header_Footer\Header_Footer::elementor_content($this->header); ?>
            </div>
        </header>
        <?php
        do_action('ElementorAddons/template/after_header');
    }

    public function add_plugin_footer_markup() {
        if (is_page_template('tpl-no-header-footer.php')) {
            return;
        }
        do_action('ElementorAddons/template/before_footer');
        ?>
        <footer itemscope="itemscope" itemtype="https://schema.org/WPFooter">
            <?php  echo \SA_EL_ADDONS\Modules\Header_Footer\Header_Footer::elementor_content($this->footer); ?>
        </footer>

        <?php
        do_action('ElementorAddons/template/after_footer');
    }

}
