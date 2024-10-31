<?php

return [
    'get_name' => 'sa_el_whatsapp_chat',
    'name' => 'Whatsapp_Chat',
    'class' => '\SA_EL_ADDONS\Elements\Whatsapp_Chat\Whatsapp_Chat',
    'dependency' => [
        'css' => [
            'tooltipster.bundle.min.css' => SA_EL_ADDONS_PATH . 'assets/vendor/tooltipster/css/tooltipster.bundle.min.css',
            'Whatsapp_Chat.css' => SA_EL_ADDONS_PATH . 'Elements/Whatsapp_Chat/assets/index.min.css',
        ],
        'js' => [
            'tooltipster.bundle.min.js' => SA_EL_ADDONS_PATH . 'assets/vendor/tooltipster/js/tooltipster.bundle.min.js',
            'Whatsapp_Chat.js' => SA_EL_ADDONS_PATH . 'Elements/Whatsapp_Chat/assets/index.min.js',
        ],
    ],
    'preview' => 'https://www.sa-elementor-addons.com/elements/whatsapp-chat/',
    'docs' => 'https://www.sa-elementor-addons.com/docs/customer-support/whatsapp-chat/',
    'category' => 'Customer Support',
    'Premium' => TRUE,
    'condition' => '',
];
