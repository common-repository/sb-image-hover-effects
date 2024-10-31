<?php

return [
    'get_name' => 'sa_el_mailchimp',
    'name' => 'Mailchimp',
    'class' => '\SA_EL_ADDONS\Elements\Mailchimp\Mailchimp',
    'dependency' => [
        'css' => [
            'Mailchimp.index.css' => SA_EL_ADDONS_PATH . 'Elements/Mailchimp/assets/index.min.css',
        ],
        'js' => [
            'Mailchimp.index.js1' => SA_EL_ADDONS_PATH . 'Elements/Mailchimp/assets/mailchimp.js',
            'Mailchimp.index.js2' => SA_EL_ADDONS_PATH . 'Elements/Mailchimp/assets/index.min.js',
        ],
    ],
    'category' => 'Form Elements',
    'Premium' => TRUE,
    'condition' => '',
    'preview' => 'https://www.sa-elementor-addons.com/elements/mailchimp/',
    'docs' => 'https://www.sa-elementor-addons.com/docs/form-elements/mailchimp/',
    'Control' => [
        'sa_el_mailchimp_api' => [
            'name' => 'Mailchimp API',
            'default' => '',
            'type' => 'text',
            'placeholder' => 'Set Your Mailchimp API CODE'
        ],
    ],
];
