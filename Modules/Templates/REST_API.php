<?php

namespace SA_EL_ADDONS\Modules\Templates;

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Description of REST_API
 * Content of Shortcode Addons Plugins
 *
 * @author $biplob018
 */
class REST_API {

    protected static $lfe_instance = NULL;

    const TRANSIENT_TEMPLATE_CATEGORY = 'sa_el_addons_category';
    const TRANSIENT_TEMPLATE = 'sa_el_addons_template';
    const API = 'https://www.sa-elementor-addons.com/wp-json/api/';

    private static $template_url = 'https://www.sa-elementor-addons.com/wp-json/api/files/%d';
    private $sources;

    /**
     * Access plugin instance. You can create further instances by calling
     */
    public static function get_instance() {
        if (NULL === self::$lfe_instance)
            self::$lfe_instance = new self;

        return self::$lfe_instance;
    }

    public function __construct() {
        if (!defined('WP_DEBUG') || WP_DEBUG == false) {
            error_reporting(0);
        }
        if (!function_exists('wp_crop_image')):
            include ABSPATH . 'wp-admin/includes/image.php';
        endif;
        $this->sources = ['saeladdons-api',];
        add_action('wp_ajax_saeladdons_get_templates', array($this, 'get_templates'));
        add_action('wp_ajax_saeladdons_core_clone_template', array($this, 'clone_template'));
        add_action('wp_ajax_saeladdons_get_layouts', [$this, 'get_layouts']);
        add_action('wp_ajax_saeladdons_custom_templates', array($this, 'custom_templates'));
        if (defined('ELEMENTOR_VERSION') && version_compare(ELEMENTOR_VERSION, '2.2.8', '>')) {
            add_action('elementor/ajax/register_actions', array($this, 'register_ajax_actions'), 20);
        } else {
            add_action('wp_ajax_elementor_get_template_data', array($this, 'get_template_data'), -1);
        }
    }

    public function get_layouts() {
        isset($_GET['tab']) || exit();
        $tabs = $_GET['tab'];
        echo json_encode(\SA_EL_ADDONS\Classes\Rest_API::get_instance()->$tabs());
        exit;
    }

    public function get_layout_data() {
        $actions = !isset($_POST['actions']) ? '' : $_POST['actions'];
        $actions = json_decode(stripslashes($actions), true);
        $template_data = reset($actions);
        $content = \SA_EL_ADDONS\Classes\Rest_API::get_instance()->get_layout_data($template_data['data']['template_id']);
        $content = $this->process_import_ids($content);
        $content = $this->process_import_content($content, 'on_import');
        return $content;
    }

    public function register_ajax_actions($ajax) {
        if (!isset($_POST['actions'])) {
            return;
        }
        $actions = json_decode(stripslashes($_REQUEST['actions']), true);
        $data = false;
        foreach ($actions as $id => $action_data) {
            if (!isset($action_data['get_template_data'])) {
                $data = $action_data;
            }
        }
        if (!$data) {
            return;
        }
        if (!isset($data['data'])) {
            return;
        }
        if (!isset($data['data']['source'])) {
            return;
        }
        if (!in_array($data['data']['source'], $this->sources)) {
            return;
        }
        $ajax->register_ajax_action('get_template_data', function($data) {
            return $this->get_layout_data();
        });
    }

    protected function process_import_ids($content) {
        return \Elementor\Plugin::$instance->db->iterate_data($content, function($element) {
                    $element['id'] = \Elementor\Utils::generate_random_string();
                    return $element;
                });
    }

    protected function process_import_content($content, $method) {
        return \Elementor\Plugin::$instance->db->iterate_data($content, function($element_data)use($method) {
                    $element = \Elementor\Plugin::$instance->elements_manager->create_element_instance($element_data);
                    if (!$element) {
                        return null;
                    }
                    $r = $this->process_import_element($element, $method);
                    return $r;
                });
    }

    protected function process_import_element($element, $method) {
        $element_data = $element->get_data();
        if (method_exists($element, $method)) {
            $element_data = $element->{$method}($element_data);
        }
        foreach ($element->get_controls()as $control) {
            $control_class = \ELementor\Plugin::$instance->controls_manager->get_control($control['type']);
            if (!$control_class) {
                return $element_data;
            }
            if (method_exists($control_class, $method)) {
                $element_data['settings'][$control['name']] = $control_class->{$method}($element->get_settings($control['name']), $control);
            }
        }
        return $element_data;
    }

    /**
     * Get a templates categories.
     * @return mixed|\WP_Error
     */
    public function TEMPLATE_CATEGORY($force_update = FALSE) {
        $response = get_transient(self::TRANSIENT_TEMPLATE_CATEGORY);
        if (!$response):
            $request = wp_remote_request(self::API . 'template');
            if (!is_wp_error($request)):
                $response = json_decode(wp_remote_retrieve_body($request), true);
                if (array_key_exists('timestamp', $response)):
                    set_transient(self::TRANSIENT_TEMPLATE_CATEGORY, $response, 3 * DAY_IN_SECONDS);
                endif;
            else:
                $response = $request->get_error_message();
            endif;
        endif;
        return $response;
    }

    /**
     * Get a templates list.
     * @return mixed|\WP_Error
     */
    public function TRANSIENT_TEMPLATE($force_update = FALSE) {
        $response = get_transient(self::TRANSIENT_TEMPLATE);
        if (!$response):
            $request = wp_remote_request(self::API . 'data');
            if (!is_wp_error($request)):
                $response = json_decode(wp_remote_retrieve_body($request), true);
                if (array_key_exists('timestamp', $response)):
                    set_transient(self::TRANSIENT_TEMPLATE, $response, 3 * DAY_IN_SECONDS);
                endif;
            else:
                $response = $request->get_error_message();
            endif;
        endif;
        return $response;
    }

    /**
     * Get a single template content.
     *
     * @param int $template_id Template ID.
     * @return mixed|\WP_Error
     */
    public function get_template_content($template_id) {
        $url = sprintf(self::$template_url, $template_id);

        $response = wp_remote_request($url);
        if (is_wp_error($response)):
            return $response;
        endif;

        $response_code = (int) wp_remote_retrieve_response_code($response);
        if (200 !== $response_code):
            return new \WP_Error('response_code_error', sprintf('The request returned with a status code of %s.', $response_code));
        endif;

        $template_content = json_decode(wp_remote_retrieve_body($response), true);
        if (isset($template_content['error'])):
            return new \WP_Error('response_error', $template_content['error']);
        endif;

        if (empty($template_content['content'])):
            return new \WP_Error('template_data_error', 'An invalid data was returned.');
        endif;
        return $template_content;
    }

    public function custom_templates() {
        if (isset($_POST['_wpnonce']) && wp_verify_nonce(sanitize_key(wp_unslash($_POST['_wpnonce'])), 'sa_elemetor_addons')):
            $id = isset($_POST['template_id']) ? (int) $_POST['template_id'] : '';
            $page = isset($_POST['with_page']) ? sanitize_text_field($_POST['with_page']) : '';
            new \SA_EL_ADDONS\Modules\Templates\Template_Import($id, $page);
        else:
            return;
        endif;
        die();
    }

}
