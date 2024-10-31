<?php

namespace SA_EL_ADDONS\Helper;

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Description of Scripts_Loader
 *
 * @author biplo
 */
use \Elementor\Core\Settings\Manager as Settings_Manager;

trait Scripts_Loader {

    /**
     * Collect dependencies for modules
     *
     * @since 1.0.0
     */
    public function generate_dependency(array $elements, $type) {
        $Registered = \SA_EL_ADDONS\Classes\Rest_API::get_instance()->Register_Elements(true);
        $paths = [];
        foreach ($elements as $element) {
            if (array_key_exists($element, $this->registered_elements)) {
                if (!empty($this->registered_elements[$element]['dependency'][$type])) {
                    foreach ($this->registered_elements[$element]['dependency'][$type] as $k => $path) {
                        $paths[] = $path;
                    }
                }
            }
        }
        return array_unique($paths);
    }

    public function minify($data = '') {
        $data = preg_replace('/\/\*((?!\*\/).)*\*\//', ' ', $data);
        $data = preg_replace('/\s{2,}/', ' ', $data);
        return $data;
    }

    /**
     * Combine files into one
     *
     * @since 1.0.0
     */
    public function combine_files($paths = array(), $file = 'sa-el-addons.min.css', $type = '') {
        $output = ($type == 'js' ? '' : '');
        if (!empty($paths)) {
            foreach ($paths as $path) {
                $output .= $this->minify(file_get_contents($this->safe_path($path)));
            }
        }
        $output .= ($type == 'js' ? '' : '');
        return file_put_contents($this->safe_path(SA_EL_ADDONS_ASSETS . $file), $output);
    }

    /**
     * Created minify CSS JS for modules
     *
     * @since 1.0.0
     */
    public function generate_scripts($elements, $file_name = null) {
        if (empty($elements)) {
            return;
        }
        $cachedir = SA_EL_ADDONS_ASSETS;
        // if folder not exists, create new folder
        if (!file_exists($cachedir)) {
            wp_mkdir_p($cachedir);
        }
        // collect sa-el-addons js
        $js_paths = array(
            SA_EL_ADDONS_PATH . 'assets/js/jquery.js',
        );
        $css_paths = array(
            SA_EL_ADDONS_PATH . 'assets/css/style.css',
        );

        // collect library scripts & styles
        $js_paths = array_merge($js_paths, $this->generate_dependency($elements, 'js'));
        $css_paths = array_merge($css_paths, $this->generate_dependency($elements, 'css'));

        // combine files
        $this->combine_files($css_paths, ($file_name ? $file_name : 'sa-el-addons') . '.min.css');
        $this->combine_files($js_paths, ($file_name ? $file_name : 'sa-el-addons') . '.min.js', 'js');
    }

    /**
     * Generate safe path
     * @since v1.0.0
     */
    public function safe_path($path) {

        $path = str_replace(['//', '\\\\'], ['/', '\\'], $path);
        return str_replace(['/', '\\'], DIRECTORY_SEPARATOR, $path);
    }

    /**
     * Generate safe path
     * @since v1.0.0
     */
    public function collect_transient_elements($widget) {
        if ($widget->get_name() === 'global') {
            $reflection = new \ReflectionClass(get_class($widget));
            $protected = $reflection->getProperty('template_data');
            $protected->setAccessible(true);
            if ($global_data = $protected->getValue($widget)) {
                $this->transient_elements = array_merge($this->transient_elements, $this->collect_recursive_elements($global_data['content']));
            }
        } else {
            $this->transient_elements[] = $widget->get_name();
        }
    }

    public function collect_recursive_elements($elements) {
        $collections = [];

        array_walk_recursive($elements, function($val, $key) use (&$collections) {
            if ($key == 'widgetType') {
                $collections[] = $val;
            }
        });

        return $collections;
    }

    /**
     * Remove files
     *
     * @since 3.0.0
     */
    public function remove_files($post_type = null, $post_id = null) {
        $css_path = $this->public_safe_path(SA_EL_ADDONS_ASSETS . DIRECTORY_SEPARATOR . ($post_type ? 'sa-el-' . $post_type : 'sa-el') . ($post_id ? '-' . $post_id : '') . '.min.css');
        $js_path = $this->public_safe_path(SA_EL_ADDONS_ASSETS . DIRECTORY_SEPARATOR . ($post_type ? 'sa-el-' . $post_type : 'sa-el') . ($post_id ? '-' . $post_id : '') . '.min.js');

        if (file_exists($css_path)) {
            unlink($css_path);
        }

        if (file_exists($js_path)) {
            unlink($js_path);
        }
    }

    public function clear_parent_cache($post_id, $data) {
        delete_metadata('post', $post_id, 'sa_el_transient_elements');
        delete_metadata('term', $post_id, 'sa_el_transient_elements');
        $this->remove_files('post', $post_id);
        $this->remove_files('term', $post_id);
    }

    public function is_preview_mode() {
        if (isset($_REQUEST['doing_wp_cron'])) {
            return true;
        }
        if (wp_doing_ajax()) {
            return true;
        }
        if (isset($_GET['elementor-preview'])) {
            return true;
        }
        if (isset($_REQUEST['action']) && $_REQUEST['action'] == 'elementor') {
            return true;
        }

        return false;
    }

    public function generate_frontend_scripts() {
        if ($this->is_preview_mode()) {
            return;
        }
        if (is_singular() || is_home() || is_archive()) {
            $queried_object = get_queried_object_id();
            $post_type = (is_singular() || is_home() ? 'post' : 'term');
            $OURElements = get_metadata($post_type, $queried_object, 'sa_el_transient_elements', true);
            if (!metadata_exists($post_type, $queried_object, 'sa_el_transient_elements') || !empty($OURElements)):
                $elements = $this->transient_elements;
                $extensions = apply_filters('sael/section/after_render', $this->transient_extensions);
                $elements = array_unique(array_merge($elements, $extensions));
                $elements = array_flip($elements);
                $Registered = get_option('sa_el_addons_register_elements');
                if (empty($Registered)):
                    $Registered = \SA_EL_ADDONS\Classes\Rest_API::get_instance()->Register_Elements(true);
                    return;
                endif;
                $OURElements = [];
                foreach ($Registered as $key => $value) {
                    if (array_key_exists('get_name', $value)):
                        if (array_key_exists($value['get_name'], $elements)):
                            $OURElements[$key] = 'on';
                        endif;
                    endif;
                }

                update_metadata($post_type, $queried_object, 'sa_el_transient_elements', $OURElements);
            endif;
            if (!empty($OURElements)) {
                $this->generate_scripts(array_keys($OURElements), 'sa-el-' . $post_type . '-' . $queried_object);
            }
        }
    }

    /**
     * Admin Ajax Loader
     * @since v1.0.0
     */
    public function saelemetoraddons_settings() {
        if (isset($_POST['_wpnonce']) && wp_verify_nonce(sanitize_key(wp_unslash($_POST['_wpnonce'])), 'sa_elemetor_addons')):
            $functionname = isset($_POST['functionname']) ? sanitize_text_field($_POST['functionname']) : '';
            $rawdata = isset($_POST['rawdata']) ? sanitize_post($_POST['rawdata']) : '';
            $satype = isset($_POST['satype']) ? sanitize_text_field($_POST['satype']) : '';
            if (!empty($functionname) && !empty($rawdata)):
                new \SA_EL_ADDONS\Classes\Admin\Admin_Render($functionname, $rawdata, $satype);
            endif;
        else:
            return;
        endif;
        die();
    }

}
