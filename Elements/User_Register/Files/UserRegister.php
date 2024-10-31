<?php

namespace SA_EL_ADDONS\Elements\User_Register\Files;

if (!defined('ABSPATH')) {
    exit;
}

class UserRegister
{

    // Setup Connection With Mailchimp
    public function sa_el_ajax_register($args)
    {
        parse_str($args, $access_info);

        if (!get_option('users_can_register')) {
            // Registration closed, display error
            echo wp_json_encode(['registered' => false, 'message' => __('Registering new users is currently not allowed.', SA_EL_ADDONS_TEXTDOMAIN)]);
        } else {
            $email      = $access_info['user_email'];
            $first_name = sanitize_text_field($access_info['first_name']);
            $last_name  = sanitize_text_field($access_info['last_name']);

            // $result     = true;
            $result     = self::sa_el_register_user($email, $first_name, $last_name);

            if (is_wp_error($result)) {
                // Parse errors into a string and append as parameter to redirect
                $errors  = $result->get_error_message();
                echo wp_json_encode(['registered' => false, 'message' => $errors]);
            } else {
                // Success
                $message = sprintf(__('You have successfully registered to <strong>%s</strong>. We have emailed your password to the email address you entered.', SA_EL_ADDONS_TEXTDOMAIN), get_bloginfo('name'));
                echo wp_json_encode(['registered' => true, 'message' => $message]);
            }
        }

        // //wp_redirect( $redirect_url );
        exit;
    }
    public static function sa_el_register_user($email, $first_name, $last_name)
    {
        $errors = new \WP_Error();

        // Email address is used as both username and email. It is also the only
        // parameter we need to validate
        if (!is_email($email)) {
            $errors->add('email', __('The email address you entered is not valid.', SA_EL_ADDONS_TEXTDOMAIN));
            return $errors;
        }

        if (username_exists($email) || email_exists($email)) {
            $errors->add('email_exists', __('An account exists with this email address.', SA_EL_ADDONS_TEXTDOMAIN));
            return $errors;
        }

        // Generate the password so that the subscriber will have to check email...
        $password = wp_generate_password(12, false);

        $user_data = array(
            'user_login'    => $email,
            'user_email'    => $email,
            'user_pass'     => $password,
            'first_name'    => $first_name,
            'last_name'     => $last_name,
            'nickname'      => $first_name,
        );

        $user_id = wp_insert_user($user_data);
        wp_new_user_notification($user_id, null, 'both');



        return $user_id;
    }
}
