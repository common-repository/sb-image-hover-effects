<?php

namespace SA_EL_ADDONS\Classes;

if (!defined('ABSPATH')) {
    exit;
}

class Build_API {

    public $param = '';
    public $prefix = '';
    public $request = null;

    public function __construct() {
        $this->config();
        $this->init();
    }

    public function config() {
        
    }

    public function init() {
        add_action('rest_api_init', function () {
            register_rest_route(untrailingslashit('ElementorAddons/v1/' . $this->prefix), '/(?P<action>\w+)/' . ltrim($this->param, '/'), array(
                'methods' => \WP_REST_Server::READABLE,
                'callback' => [$this, 'action'],
            ));
        });
    }

    public function action($request) {
        $this->request = $request;
        $action_class = strtolower($this->request->get_method()) . '_' . sanitize_key($this->request['action']);
        if (method_exists($this, $action_class)) {
            return $this->{$action_class}();
        }
    }

    public function menu_permission() {
        $user_role = get_option('oxi_addons_user_permission');
        $role_object = get_role($user_role);
        if (isset($role_object->capabilities) && is_array($role_object->capabilities)):
            reset($role_object->capabilities);
            return key($role_object->capabilities);
        else:
            return 'manage_options';
        endif;
    }

}
