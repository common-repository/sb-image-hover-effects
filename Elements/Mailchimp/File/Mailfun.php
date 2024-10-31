<?php

namespace SA_EL_ADDONS\Elements\Mailchimp\File;

if (!defined('ABSPATH')) {
    exit;
}

class Mailfun
{


    // Setup Connection With Mailchimp
    public function sa_el_mailchimp_subscribe($args, $settings)
    {
        
        $api_key = get_option('sa_el_mailchimp_api');
        parse_str($args, $formdata);
        $list_id = $settings;
        $merge_fields = array(
            'FNAME' => !empty($formdata['sa_el_mailchimp_firstname']) ? $formdata['sa_el_mailchimp_firstname'] : '',
            'LNAME' => !empty($formdata['sa_el_mailchimp_lastname']) ? $formdata['sa_el_mailchimp_lastname'] : '',
        );
        $data = array(
            'apikey' => $api_key,
            'email_address' => $formdata['sa_el_mailchimp_email'],
            'status' => 'subscribed',
            'merge_fields' =>  $merge_fields
        );

        // cURL Setup
        $sa_el_mailchimp = curl_init();
        curl_setopt($sa_el_mailchimp, CURLOPT_URL, 'https://' . substr($api_key, strpos($api_key, '-') + 1) . '.api.mailchimp.com/3.0/lists/' . $list_id . '/members/' . md5(strtolower($data['email_address'])));
        curl_setopt($sa_el_mailchimp, CURLOPT_HTTPHEADER, array('Content-Type: application/json', 'Authorization: Basic ' . base64_encode('user:' . $api_key)));
        curl_setopt($sa_el_mailchimp, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($sa_el_mailchimp, CURLOPT_CUSTOMREQUEST, 'PUT');
        curl_setopt($sa_el_mailchimp, CURLOPT_TIMEOUT, 10);
        curl_setopt($sa_el_mailchimp, CURLOPT_POST, true);
        curl_setopt($sa_el_mailchimp, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($sa_el_mailchimp, CURLOPT_POSTFIELDS, json_encode($data));

        $result = curl_exec($sa_el_mailchimp);
        if ($result->status == 400) {
            echo 'error';
        } elseif ($result->status == 'subscribed') {
            echo 'You have subscribed successfully!';
        }
        die();
    }

}