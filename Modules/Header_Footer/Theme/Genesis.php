<?php

namespace SA_EL_ADDONS\Modules\Header_Footer\Theme;

defined('ABSPATH') || exit;

class Genesis {

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
            add_action('ocean_header', [$this, 'add_plugin_header_markup']);
            add_action('genesis_header', array($this, 'genesis_header_markup_open'), 16);
            add_action('genesis_header', array($this, 'genesis_header_markup_close'), 25);
        }

        if ($this->footer != null) {
            add_action('template_redirect', array($this, 'remove_theme_footer_markup'), 10);
            add_action('genesis_footer', array($this, 'genesis_footer_markup_open'), 16);
            add_action('genesis_footer', array($this, 'genesis_footer_markup_close'), 25);
            add_action('ocean_footer', [$this, 'add_plugin_footer_markup']);
        }
    }

    public function remove_theme_header_markup() {
        for ($priority = 0; $priority < 16; $priority ++) {
            remove_all_actions('genesis_header', $priority);
        }
    }

    public function genesis_header_markup_open() {

        genesis_markup(
                array(
                    'html5' => '<header %s>',
                    'xhtml' => '<div id="header">',
                    'context' => 'site-header',
                )
        );

        genesis_structural_wrap('header');
    }

    public function genesis_header_markup_close() {

        genesis_structural_wrap('header', 'close');
        genesis_markup(
                array(
                    'html5' => '</header>',
                    'xhtml' => '</div>',
                )
        );
    }

    public function add_plugin_header_markup() {
        do_action('ElementorAddons/template/before_header');
        echo '<div class="elementor-addons-template-content-markup elementor-addons-template-content-header">';
        echo \SA_EL_ADDONS\Modules\Header_Footer\Header_Footer::elementor_content($this->header);
        echo '</div>';
        do_action('ElementorAddons/template/after_header');
    }

    public function remove_theme_footer_markup() {
        for ($priority = 0; $priority < 16; $priority ++) {
            remove_all_actions('genesis_footer', $priority);
        }
    }

    public function genesis_footer_markup_open() {
        genesis_markup(
                array(
                    'html5' => '<footer %s>',
                    'xhtml' => '<div id="footer" class="footer">',
                    'context' => 'site-footer',
                )
        );
        genesis_structural_wrap('footer', 'open');
    }

    public function genesis_footer_markup_close() {

        genesis_structural_wrap('footer', 'close');
        genesis_markup(
                array(
                    'html5' => '</footer>',
                    'xhtml' => '</div>',
                )
        );
    }

    public function add_plugin_footer_markup() {
        do_action('ElementorAddons/template/before_footer');
        echo '<div class="elementor-addons-template-content-markup elementor-addons-template-content-footer">';
        echo \SA_EL_ADDONS\Modules\Header_Footer\Header_Footer::elementor_content($this->footer);
        echo '</div>';
        do_action('ElementorAddons/template/after_footer');
    }

}
