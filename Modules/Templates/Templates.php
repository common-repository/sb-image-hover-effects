<?php

namespace SA_EL_ADDONS\Modules\Templates;

if (!defined('ABSPATH')) {
    exit;
}

use \SA_EL_ADDONS\Classes\Build_API;

class Templates extends Build_API {

    use \SA_EL_ADDONS\Modules\Templates\Templates_Render;

    public static $instance = null;

    public static function instance() {
        if (is_null(self::$instance)) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    public function config() {
        $this->prefix = 'custom_templates';
        $this->param = '/(?P<id>\w+)/';
        add_action('elementor/editor/before_enqueue_scripts', array($this, 'editor_scripts'), 1);
        add_action('elementor/editor/footer', array($this, 'admin_inline_js'));
        add_action('elementor/editor/footer', array($this, 'print_views'));
        add_action('elementor/editor/after_enqueue_styles', array($this, 'editor_styles'));
        add_action('elementor/preview/enqueue_styles', array($this, 'preview_styles'));
        new \SA_EL_ADDONS\Modules\Templates\REST_API();
        add_action('admin_menu', array($this, 'admin_menu'));
        $this->Admin_nav_menu();
    }

    public function Admin_nav_menu() {
        $menu = 'get_oxilab_addons_menu';
        $elements = get_transient($menu);
        $elements = $elements === false ? [] : $elements;
        if (!array_key_exists('Templates', array_key_exists('Elementor', $elements) ? $elements['Elementor'] : [])):
            $elements['Elementor']['Templates'] = [
                'name' => 'Templates',
                'homepage' => 'sa-el-templates'
            ];
            set_transient($menu, $elements, 10 * DAY_IN_SECONDS);
        endif;
    }

    public function admin_menu() {
        add_submenu_page('sa-el-addons', 'Templates', 'Templates', $this->menu_permission(), 'sa-el-templates', [$this, 'templates']);
    }

    public function editor_scripts() {
        wp_enqueue_script(
                'saeladdons-library-editor-script',
                SA_EL_ADDONS_URL . 'Modules/Templates/assets/js/editor.js',
                array('jquery', 'underscore', 'backbone-marionette'),
                SA_EL_ADDONS_PLUGIN_VERSION,
                true
        );
    }

    public function admin_inline_js() {
        ?>
        <script type="text/javascript" >

            var ElementorAddonsLibreryData = {
                "libraryButton": "Elements Button",
                "modalRegions": {
                    "modalHeader": ".dialog-header",
                    "modalContent": ".dialog-message"
                },
                "license": {
                    "activated": true,
                    "link": ""
                },
                "tabs": {
                    "saeladdons_page": {
                        "title": "Templates",
                        "data": [],
                        "sources": ["saeladdons-theme", "saeladdons-api"],
                        "settings": {
                            "show_title": true,
                            "show_keywords": true
                        }
                    },

                    "saeladdons_section": {
                        "title": "Blocks",
                        "data": [],
                        "sources": ["saeladdons-theme", "saeladdons-api"],
                        "settings": {
                            "show_title": false,
                            "show_keywords": true
                        }
                    },
                    "saeladdons_preset": {
                        "title": "Presets",
                        "data": [],
                        "sources": ["saeladdons-theme", "saeladdons-api"],
                        "settings": {
                            "show_title": false,
                            "show_keywords": true
                        }
                    },
                    "saeladdons_header": {
                        "title": "Headers",
                        "data": [],
                        "sources": ["saeladdons-theme", "saeladdons-api"],
                        "settings": {
                            "show_title": false,
                            "show_keywords": true
                        }
                    },
                    "saeladdons_footer": {
                        "title": "Footers",
                        "data": [],
                        "sources": ["saeladdons-theme", "saeladdons-api"],
                        "settings": {
                            "show_title": false,
                            "show_keywords": true
                        }
                    }
                },
                "defaultTab": "saeladdons_page"
            };

        </script> <?php

    }

    public function print_views() {
        foreach (glob(SA_EL_ADDONS_PATH . 'Modules/Templates/views/*.php') as $file) {
            $name = basename($file, '.php');
            ob_start();
            include $file;
            printf('<script type="text/html" id="view-saeladdons-%1$s">%2$s</script>', $name, ob_get_clean());
        }
    }

    public function editor_styles() {
        wp_enqueue_style('saeladdons-library-editor-style', SA_EL_ADDONS_URL . 'Modules/Templates/assets/css/editor.css', array(), SA_EL_ADDONS_PLUGIN_VERSION);
    }

    public function preview_styles() {
        wp_enqueue_style('saeladdons-library-preview-style', SA_EL_ADDONS_URL . 'Modules/Templates/assets/css/preview.css', array(), SA_EL_ADDONS_PLUGIN_VERSION);
    }

    public function templates() {
        new \SA_EL_ADDONS\Modules\Templates\views\Templates();
    }

    public function get_templates() {
        $type = $this->request['type'];
        $section = $this->request['section'];
        $fn = $type . '_render';
        return $this->$fn($section);
    }

}
