<?php

namespace SA_EL_ADDONS\Elements\User_Login\Files;

if (!defined('ABSPATH')) {
    exit;
}

class UserLogin
{


    // Setup Connection With Mailchimp
    public function sa_el_ajax_login($args)
    {
        parse_str($args, $access_info);
        wp_verify_nonce('ajax-login-nonce', $access_info['sa-el-user-login-sc']);
        $access = [];
        $access['user_login']    = !empty($access_info['log']) ? $access_info['log'] : "";
        $access['user_password'] = !empty($access_info['pwd']) ? $access_info['pwd'] : "";
        $access['rememberme']    = true;
        $user_signon = wp_signon($access, false);
        if (!is_wp_error($user_signon)) {
            echo wp_json_encode(['loggedin' => true, 'message' => esc_html__('Login successful, Redirecting...', SA_EL_ADDONS_TEXTDOMAIN)]);
        } else {
            echo wp_json_encode(['loggedin' => false, 'message' => esc_html__('Ops! Wrong username or password!', SA_EL_ADDONS_TEXTDOMAIN)]);
        }

        die();
    }
}
