<?php

namespace SA_EL_ADDONS\Classes\Admin;

if (!defined('ABSPATH')) {
    exit;
}

class Admin_Render {

    // instance container
    private static $instance = null;

    public function __construct($function = '', $data = '', $satype = '') {

        if (!empty($function) && !empty($data)) {
            $this->$function($data, $satype);
        }
    }

    public static function instance() {
        if (self::$instance == null) {
            self::$instance = new self;
        }

        return self::$instance;
    }

    /**
     * Remove files in dir
     *
     * @since 1.0.0
     */
    public function empty_dir($path) {
        if (!is_dir($path) || !file_exists($path)) {
            return;
        }
        foreach (scandir($path) as $item) {
            if ($item == '.' || $item == '..') {
                continue;
            }
            unlink($this->safe_path($path . DIRECTORY_SEPARATOR . $item));
        }
    }

    /**
     * Generate safe path
     * @since v1.0.0
     */
    public function safe_path($path) {
        $path = str_replace(['//', '\\\\'], ['/', '\\'], $path);
        return str_replace(['/', '\\'], DIRECTORY_SEPARATOR, $path);
    }

    public function addons_settings($data, $satype) {
        parse_str($data, $settings);
        $update = json_encode($settings);
        $this->empty_dir(SA_EL_ADDONS_ASSETS);
        update_option('shortcode-addons-elementor', $update);
    }

    public function modal_settings($data, $satype) {
        parse_str($data, $settings);
        foreach ($settings as $key => $value) {
            update_option($key, $value);
        }
        echo json_encode($settings);
    }

    public function addons_cache($data, $satype) {
        $this->empty_dir(SA_EL_ADDONS_ASSETS);
        delete_metadata('post', 0, 'sa_el_transient_elements', '', true);
        delete_metadata('term', 0, 'sa_el_transient_elements', '', true);
        return wp_send_json(true);
    }

    public function online_cache() {
        $this->empty_dir(SA_EL_ADDONS_ASSETS);
        delete_metadata('post', 0, 'sa_el_transient_elements', '', true);
        delete_metadata('term', 0, 'sa_el_transient_elements', '', true);
        return true;
    }

    /**
     * Remove files
     *
     * @since 3.0.0
     */
    public function remove_files($post_type = null, $post_id = null) {

        $css_path = $this->safe_path(SA_EL_ADDONS_ASSETS . DIRECTORY_SEPARATOR . ($post_type ? 'sa-el-' . $post_type : 'sa-el-addons') . ($post_id ? '-' . $post_id : '') . '.min.css');
        $js_path = $this->safe_path(SA_EL_ADDONS_ASSETS . DIRECTORY_SEPARATOR . ($post_type ? 'sa-el-' . $post_type : 'sa-el-addons') . ($post_id ? '-' . $post_id : '') . '.min.js');

        if (file_exists($css_path)) {
            unlink($css_path);
        }

        if (file_exists($js_path)) {
            unlink($js_path);
        }
        echo delete_metadata($post_type, $post_id, 'sa_el_transient_elements');
        ;
    }

    public function addons_page_cache($arg, $settings, $optional) {
        if ($optional == 'single' && (int) $settings):
            self::instance()->remove_files('post', $settings);
            self::instance()->remove_files('term', $settings);
        endif;
        if ($optional == 'clear_all'):
            self::instance()->online_cache();
        endif;
    }

}
