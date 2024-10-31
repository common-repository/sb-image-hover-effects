<?php

namespace SA_EL_ADDONS\Classes;

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Description of Rest_API
 * Content of Shortcode Addons Plugins
 *
 * @author $biplob018
 */
class Rest_API {

    protected static $lfe_instance = NULL;
    public $dapi = FALSE;

    const TRANSIENT_REGISTER_ELEMENTS = 'sa_el_addons_register_elements';
    const template_layouts = 'sa_el_addons_template_layouts';
    const blocks_layouts = 'sa_el_addons_blocks_layouts';
    const preset_layouts = 'sa_el_addons_preset_layouts';
    const header_layouts = 'sa_el_addons_header_layouts';
    const footer_layouts = 'sa_el_addons_footer_layouts';
    const API = 'https://www.sa-elementor-addons.com/wp-json/api/';

    private static $template_url = 'https://www.sa-elementor-addons.com/wp-json/api/files/%d';

    public function __construct() {
        $d = get_option('oxi_addons_license_status');
        if ($d == 'valid'):
            $this->dapi = TRUE;
        endif;
    }

    /**
     * Access plugin instance. You can create further instances by calling
     */
    public static function get_instance() {
        if (NULL === self::$lfe_instance)
            self::$lfe_instance = new self;

        return self::$lfe_instance;
    }

    /**
     * Get a templates list.
     * @return mixed|\WP_Error
     */
    public function saeladdons_page() {
        $response = get_transient(self::template_layouts);
        if (!$response):
            $request = wp_remote_request(self::API . 'template_layouts');
            if (!is_wp_error($request)):
                $response = json_decode(wp_remote_retrieve_body($request), true);
                if (array_key_exists('timestamp', $response)):
                    set_transient(self::template_layouts, $response, 3 * DAY_IN_SECONDS);
                endif;
            else:
                $response = $request->get_error_message();
            endif;
        endif;
        if ($this->dapi == TRUE):
            array_walk_recursive(
                    $response,
                    function (&$value) {
                $value = ($value == 'pro' ? 'free' : $value);
            });
        endif;
        return $response;
    }

    /**
     * Get a templates list.
     * @return mixed|\WP_Error
     */
    public function saeladdons_section() {
        $response = get_transient(self::blocks_layouts);
        if (!$response):
            $request = wp_remote_request(self::API . 'blocks_layouts');
            if (!is_wp_error($request)):
                $response = json_decode(wp_remote_retrieve_body($request), true);
                if (array_key_exists('timestamp', $response)):
                    set_transient(self::blocks_layouts, $response, 3 * DAY_IN_SECONDS);
                endif;
            else:
                $response = $request->get_error_message();
            endif;
        endif;
        if ($this->dapi == TRUE):
            array_walk_recursive(
                    $response,
                    function (&$value) {
                $value = ($value == 'pro' ? 'free' : $value);
            });
        endif;

        return $response;
    }

    /**
     * Get a templates list.
     * @return mixed|\WP_Error
     */
    public function saeladdons_preset() {
        $response = get_transient(self::preset_layouts);
        if (!$response):
            $request = wp_remote_request(self::API . 'preset_layouts');
            if (!is_wp_error($request)):
                $response = json_decode(wp_remote_retrieve_body($request), true);
                if (array_key_exists('timestamp', $response)):
                    set_transient(self::preset_layouts, $response, 3 * DAY_IN_SECONDS);
                endif;
            else:
                $response = $request->get_error_message();
            endif;
        endif;
        if ($this->dapi == TRUE):
            array_walk_recursive(
                    $response,
                    function (&$value) {
                $value = ($value == 'pro' ? 'free' : $value);
            });
        endif;
        return $response;
    }
     /**
     * Get a templates list.
     * @return mixed|\WP_Error
     */
    public function saeladdons_header() {
        $response = get_transient(self::header_layouts);
        if (!$response):
            $request = wp_remote_request(self::API . 'header_layouts');
            if (!is_wp_error($request)):
                $response = json_decode(wp_remote_retrieve_body($request), true);
                if (array_key_exists('timestamp', $response)):
                    set_transient(self::header_layouts, $response, 3 * DAY_IN_SECONDS);
                endif;
            else:
                $response = $request->get_error_message();
            endif;
        endif;
        if ($this->dapi == TRUE):
            array_walk_recursive(
                    $response,
                    function (&$value) {
                $value = ($value == 'pro' ? 'free' : $value);
            });
        endif;
        return $response;
    }
/**
     * Get a templates list.
     * @return mixed|\WP_Error
     */
    public function saeladdons_footer() {
        $response = get_transient(self::footer_layouts);
        if (!$response):
            $request = wp_remote_request(self::API . 'footer_layouts');
            if (!is_wp_error($request)):
                $response = json_decode(wp_remote_retrieve_body($request), true);
                if (array_key_exists('timestamp', $response)):
                    set_transient(self::footer_layouts, $response, 3 * DAY_IN_SECONDS);
                endif;
            else:
                $response = $request->get_error_message();
            endif;
        endif;
        if ($this->dapi == TRUE):
            array_walk_recursive(
                    $response,
                    function (&$value) {
                $value = ($value == 'pro' ? 'free' : $value);
            });
        endif;
        return $response;
    }
    /**
     * Get a single template content.
     *
     * @param int $template_id Template ID.
     * @return mixed|\WP_Error
     */
    public function get_layout_data($template_id) {
        $url = sprintf(self::API . 'get_layout/%d', $template_id);

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

    /**
     * Get a single template content.
     *
     * @param int $template_id Template ID.
     * @return mixed|\WP_Error
     */
    public function Register_Elements($force_update = false) {
        $Register = get_transient(self::TRANSIENT_REGISTER_ELEMENTS);
        if (!$Register || $force_update):
            $Register = [];
            $file = glob(SA_EL_ADDONS_PATH . 'Elements' . '/*', GLOB_ONLYDIR);
            foreach ($file as $V) {
                $F = explode('/Elements/', $V);
                if (file_exists(SA_EL_ADDONS_PATH . 'Elements' . '/' . $F[1] . '/Register.php')):
                    $R = include_once SA_EL_ADDONS_PATH . 'Elements' . '/' . $F[1] . '/Register.php';
                    if (is_array($R) && array_key_exists('name', $R)):
                        $Register[$R['name']] = $R;
                    endif;
                endif;
            }
            $file = glob(SA_EL_ADDONS_PATH . 'Extensions' . '/*', GLOB_ONLYDIR);
            foreach ($file as $V) {
                $F = explode('/Extensions/', $V);
                if (file_exists(SA_EL_ADDONS_PATH . 'Extensions' . '/' . $F[1] . '/Register.php')):
                    $R = include_once SA_EL_ADDONS_PATH . 'Extensions' . '/' . $F[1] . '/Register.php';
                    if (is_array($R) && array_key_exists('name', $R)):
                        $Register[$R['name']] = $R;
                    endif;
                endif;
            }
            $file = glob(SA_EL_ADDONS_PATH . 'Modules' . '/*', GLOB_ONLYDIR);
            foreach ($file as $V) {
                $F = explode('/Modules/', $V);
                if (file_exists(SA_EL_ADDONS_PATH . 'Modules' . '/' . $F[1] . '/Register.php')):
                    $R = include_once SA_EL_ADDONS_PATH . 'Modules' . '/' . $F[1] . '/Register.php';
                    if (is_array($R) && array_key_exists('name', $R)):
                        $Register[$R['name']] = $R;
                    endif;
                endif;
            }
            update_option(self::TRANSIENT_REGISTER_ELEMENTS, $Register);
            set_transient(self::TRANSIENT_REGISTER_ELEMENTS, $Register, 5 * DAY_IN_SECONDS);
        endif;
        return $Register;
    }

}
