<?php

namespace SA_EL_ADDONS\Modules\Header_Footer\Theme;

defined('ABSPATH') || exit;

class Generatepress {

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
            add_action('template_redirect', array($this, 'remove_theme_header_markup'), 10);
            add_action('generate_header', [$this, 'add_plugin_header_markup']);
        }

        if ($this->footer != null) {
            add_action('template_redirect', array($this, 'remove_theme_footer_markup'), 10);
            add_action('generate_footer', [$this, 'add_plugin_footer_markup']);
        }
    }

    public function remove_theme_header_markup() {
        remove_action('generate_header', 'generate_construct_header');
    }

    public function add_plugin_header_markup() {
        do_action('ElementorAddons/template/before_header');
        echo '<div class="elementor-addons-template-content-markup elementor-addons-template-content-header">';
        echo \SA_EL_ADDONS\Modules\Header_Footer\Header_Footer::elementor_content($this->header);
        echo '</div>';
        do_action('ElementorAddons/template/after_header');
    }

    public function remove_theme_footer_markup() {
        remove_action('generate_footer', 'generate_construct_footer_widgets', 5);
        remove_action('generate_footer', 'generate_construct_footer');
    }

    public function add_plugin_footer_markup() {
        do_action('ElementorAddons/template/before_footer');
        echo '<div class="elementor-addons-template-content-markup elementor-addons-template-content-footer">';
        echo \SA_EL_ADDONS\Modules\Header_Footer\Header_Footer::elementor_content($this->footer);
        echo '</div>';
        do_action('ElementorAddons/template/after_footer');
    }

}
