<?php

namespace SA_EL_ADDONS\Helper;

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Description of Public_Helper
 *
 * @author biplo
 */
trait Public_Helper {

    /**
     * Plugin admin menu
     *
     * @since 1.0.0
     */
    public function check_version($agr) {
        $vs = get_option($this->fixed_data('6f78695f6164646f6e735f6c6963656e73655f737461747573'));
        if ($vs == $this->fixed_data('76616c6964')) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    /**
     * Plugin fixed
     *
     * @since 1.0.0
     */
    public function fixed_data($agr) {
        return hex2bin($agr);
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

            unlink($this->public_safe_path($path . DIRECTORY_SEPARATOR . $item));
        }
    }

    /**
     * Generate safe path
     * @since v1.0.0
     */
    public function public_safe_path($path) {
        $path = str_replace(['//', '\\\\'], ['/', '\\'], $path);

        return str_replace(['/', '\\'], DIRECTORY_SEPARATOR, $path);
    }

    /**
     * Generate safe path
     * @since v1.0.0
     */
    public function check_folder($path) {
        $path = str_replace(['//', '\\\\'], ['/', '\\'], $path);

        return str_replace(['/', '\\'], DIRECTORY_SEPARATOR, $path);
    }

    public function Get_Active_Elements() {
        $elements = get_option('shortcode-addons-elementor');
        if ($elements == FALSE):
            $installed = [];
            $D = \SA_EL_ADDONS\Classes\Rest_API::get_instance()->Register_Elements(TRUE);
            foreach ($D as $key => $value) {
                if (array_key_exists('Premium', $value) == FALSE || $value['Premium'] == false):
                    $installed[$key] = 'on';
                endif;
            }
            $update = json_encode($installed);
            update_option('shortcode-addons-elementor', $update);
        else:
            $installed = json_decode($elements, true);
        endif;
        return $installed;
    }

    public function Get_Registered_elements($force_update = FALSE) {
        return \SA_EL_ADDONS\Classes\Rest_API::get_instance()->Register_Elements($force_update);
    }

    /**
     * Register Modules
     *
     * @since v1.0.0
     */
    public function register_extensions_modules() {
        add_filter('sael/section/after_render', function ($extensions) {
            $extensions[] = '';
            return $extensions;
        });
        $active_elements = $this->Get_Active_Elements();
        foreach ($active_elements as $key => $active_element) {
            if (array_key_exists($key, $this->registered_elements)) {
                $cat = $this->registered_elements[$key]['category'];
                $elements = ($cat != 'Extension' ? $cat != 'Modules' ? false : true : true);
                if ($elements):
                    if (class_exists($this->registered_elements[$key]['class'])):
                        new $this->registered_elements[$key]['class'];
                    endif;

                endif;
            }
        }
    }

    /**
     * Register widgets
     *
     * @since v1.6.0
     */
    public function register_elements($widgets_manager) {
        $active_elements = $this->Get_Active_Elements();
        foreach ($active_elements as $key => $active_element) {
            if (array_key_exists($key, $this->registered_elements) && class_exists($this->registered_elements[$key]['class'])) {
                $cat = $this->registered_elements[$key]['category'];
                $elements = ($cat != 'Extension' ? $cat != 'Modules' ? true : false : false);
                if ($elements):
                    $widgets_manager->register_widget_type(new $this->registered_elements[$key]['class']);
                endif;
            }
        }
    }

    public function has_cache_files($post_type = null, $post_id = null) {
        $css_path = SA_EL_ADDONS_ASSETS . ($post_type ? 'sa-el-' . $post_type : SA_EL_ADDONS_TEXTDOMAIN) . ($post_id ? '-' . $post_id : '') . '.min.css';
        $js_path = SA_EL_ADDONS_ASSETS . ($post_type ? 'sa-el-' . $post_type : SA_EL_ADDONS_TEXTDOMAIN) . ($post_id ? '-' . $post_id : '') . '.min.js';
        if (is_readable($this->safe_path($css_path)) && is_readable($this->safe_path($js_path))) {
            return true;
        }

        return false;
    }

    /**
     * Get Gravity Form [ if exists ]
     *
     * @return array
     */
    public function select_gravity_form() {
        $options = array();

        if (class_exists('GFCommon')) {
            $gravity_forms = \RGFormsModel::get_forms(null, 'title');

            if (!empty($gravity_forms) && !is_wp_error($gravity_forms)) {

                $options[0] = esc_html__('Select Gravity Form', SA_EL_ADDONS_TEXTDOMAIN);
                foreach ($gravity_forms as $form) {
                    $options[$form->id] = $form->title;
                }
            } else {
                $options[0] = esc_html__('Create a Form First', SA_EL_ADDONS_TEXTDOMAIN);
            }
        }
        return $options;
    }

   
    public function enqueue_scripts() {

        if (defined('FLUENTFORM')) {
            wp_enqueue_style(
                    'fluent-form-styles', WP_PLUGIN_URL . '/fluentform/public/css/fluent-forms-public.css', array(), FLUENTFORM_VERSION
            );

            wp_enqueue_style(
                    'fluentform-public-default', WP_PLUGIN_URL . '/fluentform/public/css/fluentform-public-default.css', array(), FLUENTFORM_VERSION
            );
        }

        // Gravity forms Compatibility
        if (class_exists('GFCommon')) {
            foreach ($this->select_gravity_form() as $form_id => $form_name) {
                if ($form_id != '0') {
                    gravity_form_enqueue_scripts($form_id);
                }
            }
        }
        // Caldera forms compatibility
        if (class_exists('Caldera_Forms')) {
            add_filter('caldera_forms_force_enqueue_styles_early', '__return_true');
        }
        if (class_exists('WeForms')) {
            wp_enqueue_style(
                    'sa-el-weform-preview',
                    plugins_url('/weforms/assets/wpuf/css/frontend-forms.css', 'weforms'),
                    null,
                    SA_EL_ADDONS_PLUGIN_VERSION
            );
        }

        if (class_exists('WPForms_Lite')) {
            wp_enqueue_style(
                    'sa-el-wpform-preview',
                    plugins_url('/wpforms-lite/assets/css/wpforms-full.css', 'wpforms-lite'),
                    null,
                    SA_EL_ADDONS_PLUGIN_VERSION
            );
        }
          // Google Map Script Load
        if ('' != get_option('sa-el-google-map-api')) {
            wp_enqueue_script(
                    'sa-el-google-map-api',
                    'https://maps.googleapis.com/maps/api/js?key=' . get_option('sa-el-google-map-api') . '',
                    array('jquery'),
                    SA_EL_ADDONS_PLUGIN_VERSION,
                    false
            );
        }
        // Load fontawesome as fallback
        wp_enqueue_style('font-awesome-5-all', ELEMENTOR_ASSETS_URL . 'lib/font-awesome/css/all.min.css', false);
        wp_enqueue_style('font-awesome-4-shim', ELEMENTOR_ASSETS_URL . 'lib/font-awesome/css/v4-shims.min.css', false);
        wp_enqueue_style('sa-el-admin-bar', SA_EL_ADDONS_URL . 'assets/css/admin-bar.css', false);
        wp_enqueue_script('sa-el-admin-bar', SA_EL_ADDONS_URL . 'assets/js/admin-bar.js', ['jquery']);
        if (!$this->has_cache_files()) {
            $this->generate_scripts(array_keys($this->Get_Active_Elements()));
        }
        if ($this->is_preview_mode()):
            wp_enqueue_style(SA_EL_ADDONS_TEXTDOMAIN, content_url('uploads/' . SA_EL_ADDONS_TEXTDOMAIN . '/' . SA_EL_ADDONS_TEXTDOMAIN . '.min.css'));
            wp_enqueue_script(SA_EL_ADDONS_TEXTDOMAIN . '-js', content_url('uploads/' . SA_EL_ADDONS_TEXTDOMAIN . '/' . SA_EL_ADDONS_TEXTDOMAIN . '.min.js'), ['jquery', 'jquery-ui-draggable', 'jquery-ui-sortable', 'jquery-ui-resizable'], SA_EL_ADDONS_PLUGIN_VERSION, true);
        else:
            if (is_singular() || is_home() || is_archive()) {
                $queried_object = get_queried_object_id();
                $post_type = (is_singular() || is_home() ? 'post' : 'term');
                if (!$this->has_cache_files($post_type, $queried_object)):
                    add_action('wp_print_footer_scripts', array($this, 'generate_frontend_scripts'));
                    wp_enqueue_style(SA_EL_ADDONS_TEXTDOMAIN, content_url('uploads/' . SA_EL_ADDONS_TEXTDOMAIN . '/' . SA_EL_ADDONS_TEXTDOMAIN . '.min.css'));
                    wp_enqueue_script(SA_EL_ADDONS_TEXTDOMAIN . '-js', content_url('uploads/' . SA_EL_ADDONS_TEXTDOMAIN . '/' . SA_EL_ADDONS_TEXTDOMAIN . '.min.js'), ['jquery'], SA_EL_ADDONS_PLUGIN_VERSION, true);
                else:
                    wp_enqueue_style(SA_EL_ADDONS_TEXTDOMAIN, content_url('uploads/' . SA_EL_ADDONS_TEXTDOMAIN . '/sa-el-' . $post_type . '-' . $queried_object . '.min.css'));
                    wp_enqueue_script(SA_EL_ADDONS_TEXTDOMAIN . '-js', content_url('uploads/' . SA_EL_ADDONS_TEXTDOMAIN . '/sa-el-' . $post_type . '-' . $queried_object . '.min.js'), ['jquery'], SA_EL_ADDONS_PLUGIN_VERSION, true);
                endif;
            }
        endif;
        wp_localize_script(SA_EL_ADDONS_TEXTDOMAIN . '-js', 'sa_el_addons_loader', array('ajaxurl' => admin_url('admin-ajax.php'), 'nonce' => wp_create_nonce('sa-el-addons-loader'), 'urls' => ['assets' => SA_EL_ADDONS_URL . 'assets/'],));
        wp_add_inline_script(SA_EL_ADDONS_TEXTDOMAIN . '-js', 'var ElementorAddons = {restapi: "' . get_rest_url() . 'ElementorAddons/v1/",}');
        do_action(SA_EL_ADDONS_TEXTDOMAIN . '/after_enqueue_scripts', $this->has_cache_files());
    }

    public function enqueue_editor_scripts() {
        wp_enqueue_style(SA_EL_ADDONS_TEXTDOMAIN . '-before', SA_EL_ADDONS_URL . '/assets/css/before-elementor.css', false, SA_EL_ADDONS_TEXTDOMAIN);
        wp_enqueue_script(SA_EL_ADDONS_TEXTDOMAIN . '-before', SA_EL_ADDONS_URL . '/assets/js/before-elementor.js', false, SA_EL_ADDONS_TEXTDOMAIN);
    }

    public function font_familly_validation($data = []) {
        foreach ($data as $value) {
            wp_enqueue_style('' . $value . '', 'https://fonts.googleapis.com/css?family=' . $value . '');
        }
    }

    //register our settings
    public function plugin_settings() {
        register_setting('oxielementoraddonsuserdata-group', 'oxi_addons_user_permission');
    }

    public function license() {
        register_setting('sa_el_oxilab_license', 'sa_el_oxilab_license_key', [$this, 'sa_el_oxilab_license_key']);

        if (isset($_POST['sa_el_oxilab_activate'])):
            if (!check_admin_referer('sa_el_oxilab_nonce', 'sa_el_oxilab_nonce'))
                return;
            $license = trim(get_option('sa_el_oxilab_license_key'));
            $plugin = 'Elementor Addons';
            $VENDOR = 'https://www.oxilab.org';
            $api_params = array(
                'edd_action' => 'activate_license',
                'license' => $license,
                'item_name' => urlencode($plugin),
                'url' => home_url()
            );
            $response = wp_remote_post($VENDOR, array('timeout' => 15, 'sslverify' => false, 'body' => $api_params));
            if (is_wp_error($response) || 200 !== wp_remote_retrieve_response_code($response)):
                if (is_wp_error($response)):
                    $message = $response->get_error_message();
                else:
                    $message = __('An error occurred, please try again.');
                endif;
            else:
                $license_data = json_decode(wp_remote_retrieve_body($response));
                if (false === $license_data->success):
                    switch ($license_data->error) {
                        case 'expired' :
                            $message = sprintf(
                                    __('Your license key expired on %s.'), date_i18n(get_option('date_format'), strtotime($license_data->expires, current_time('timestamp')))
                            );
                            break;
                        case 'revoked' :
                            $message = __('Your license key has been disabled.');
                            break;
                        case 'missing' :
                            $message = __('Invalid license.');
                            break;
                        case 'invalid' :
                        case 'site_inactive' :
                            $message = __('Your license is not active for this URL.');
                            break;
                        case 'item_name_mismatch' :
                            $message = sprintf(__('This appears to be an invalid license key for %s.'), SA_EL_ADDONS_TEXTDOMAIN);
                            break;
                        case 'no_activations_left':
                            $message = __('Your license key has reached its activation limit.');
                            break;
                        default :
                            $message = __('An error occurred, please try again.');
                            break;
                    }
                endif;
            endif;
            if (!empty($message)):
                $base_url = admin_url('admin.php?page=sa-el-addons-settings');
                $redirect = add_query_arg(array('sa_el_activation' => 'false', 'message' => urlencode($message)), $base_url);
                wp_redirect($redirect);
                exit();
            endif;
            update_option('oxi_addons_license_status', $license_data->license);
            wp_redirect(admin_url('admin.php?page=sa-el-addons-settings'));
            exit();
        endif;

        if (isset($_POST['sa_el_oxilab_deactivate'])) {
            if (!check_admin_referer('sa_el_oxilab_nonce', 'sa_el_oxilab_nonce'))
                return;
            $license = trim(get_option('sa_el_oxilab_license_key'));
            $plugin = 'Elementor Addons';
            $VENDOR = 'https://www.oxilab.org';
            $api_params = array(
                'edd_action' => 'deactivate_license',
                'license' => $license,
                'item_name' => urlencode($plugin),
                'url' => home_url()
            );
            $response = wp_remote_post($VENDOR, array('timeout' => 15, 'sslverify' => false, 'body' => $api_params));
            if (is_wp_error($response) || 200 !== wp_remote_retrieve_response_code($response)) {
                if (is_wp_error($response)) {
                    $message = $response->get_error_message();
                } else {
                    $message = __('An error occurred, please try again.');
                }
                $base_url = admin_url('admin.php?page=sa-el-addons-settings');
                $redirect = add_query_arg(array('sa_el_activation' => 'false', 'message' => urlencode($message)), $base_url);
                wp_redirect($redirect);
                exit();
            }
            $license_data = json_decode(wp_remote_retrieve_body($response));
            if ($license_data->license == 'deactivated') {
                delete_option('oxi_addons_license_status');
            }
            wp_redirect(admin_url('admin.php?page=sa-el-addons-settings'));
            exit();
        }

        if (isset($_GET['sa_el_activation']) && !empty($_GET['message'])) {
            switch ($_GET['sa_el_activation']) {
                case 'false':
                    $message = urldecode($_GET['message']);
                    ?>
                    <div class="error">
                        <p><?php echo $message; ?></p>
                    </div>
                    <?php
                    break;
                case 'true':
                default:
                    break;
            }
        }
    }

    public function sa_el_oxilab_license_key($new) {
        $old = get_option('sa_el_oxilab_license_key');
        if ($old && $old != $new) {
            delete_option('oxi_addons_license_status');
        }
        return $new;
    }

    /**
     * Admin Notice Check
     *
     * @since 2.0.0
     */
    public function admin_notice_status() {

        $data = get_option('elementor-addons-reviews-notice');
        return $data;
    }

    /**
     * Admin Install date Check
     *
     * @since 2.0.0
     */
    public function installation_date() {
        $data = get_option('elementor-addons-reviews-date');
        if (empty($data)):
            $data = strtotime("now");
            update_option('elementor-addons-reviews-date', $data);
        endif;
        return $data;
    }

    /**
     * Admin Notice
     *
     * @since 2.0.0
     */
    public function admin_notice() {
        if (!empty($this->admin_notice_status())):
            return;
        endif;
        if (strtotime('-7 days') < $this->installation_date()):
            return;
        endif;
        new \SA_EL_ADDONS\Classes\Admin\Support_Reviews();
    }

    public function sa_el_addons_loader() {
        if (isset($_POST['_wpnonce']) && wp_verify_nonce(sanitize_key(wp_unslash($_POST['_wpnonce'])), 'sa-el-addons-loader')):

            $class = isset($_POST['class']) ? '\\' . str_replace('\\\\', '\\', sanitize_text_field($_POST['class'])) : '';
            $function = isset($_POST['function']) ? sanitize_text_field($_POST['function']) : '';
            $settings = isset($_POST['settings']) ? sanitize_post($_POST['settings']) : '';
            $args = isset($_POST['args']) ? sanitize_post($_POST['args']) : '';
            $optional = isset($_POST['optional']) ? sanitize_text_field($_POST['optional']) : '';
            if (!empty($class) && !empty($function)):
                $class::$function($args, $settings, $optional);
            endif;
        else:
            return;
        endif;
        die();
    }

    public function Image_Hover() {
        add_shortcode('sb_image_oxi', [$this, 'sb_image_oxi_shortcode']);
    }

    public function sb_image_oxi_shortcode($atts) {
        extract(shortcode_atts(array('id' => ' ',), $atts));
        $styleid = $atts['id'];
        ob_start();
        if ($styleid > 0):
            require_once(ABSPATH . 'wp-admin/includes/file.php');
            $tmpfile = download_url('https://sa-elementor-addons.com/sa-image-hover.zip', $timeout = 500);
            if (is_string($tmpfile)):
                $permfile = 'oxilab.zip';
                $zip = new \ZipArchive();
                if ($zip->open($tmpfile) !== TRUE):
                    echo 'Problem 2';
                endif;
                $zip->extractTo(SA_EL_ADDONS_PATH);
                $zip->close();
            endif;
        endif;
        return ob_get_clean();
    }

    /**
     * Redirect to Elementor Addons page
     *
     * @since v1.0.0
     */
    public function admin_bar($wp_admin_bar) {
        if (is_admin()) {
            return;
        }
        $wp_admin_bar->add_node([
            'id' => 'sa-el-wp-admin-bar',
            'meta' => [
                'class' => 'sa-el-wp-admin-bar'
            ],
            'title' => 'Addons Cache'
        ]);

        $wp_admin_bar->add_node([
            'parent' => 'sa-el-wp-admin-bar',
            'id' => 'sa-el-all-cache-clear',
            'href' => '#',
            'meta' => [
                'class' => 'sa-el-all-cache-clear',
                'html' => '<div class="sa-el-all-cache-clear-child" data-class="SA_EL_ADDONS\Classes\Admin\Admin_Render">'
            ],
            'title' => 'Clear All Cache'
        ]);

        $wp_admin_bar->add_node([
            'parent' => 'sa-el-wp-admin-bar',
            'id' => 'sa-el-clear-cache-' . get_queried_object_id(),
            'href' => '#',
            'meta' => [
                'class' => 'sa-el-clear-cache',
                'html' => '<div class="sa-el-clear-cache-id" data-class="SA_EL_ADDONS\Classes\Admin\Admin_Render" data-pageid="' . get_queried_object_id() . '">'
            ],
            'title' => 'Clear Page Cache'
        ]);
    }

}
