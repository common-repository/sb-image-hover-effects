<?php

return [
    'get_name' => 'sa_el_help_desk',
    'name' => 'Help_Desk',
    'class' => '\SA_EL_ADDONS\Elements\Help_Desk\Help_Desk',
    'dependency' => [
        'css' => [
            'tippy.min.css' => SA_EL_ADDONS_PATH . 'assets/vendor/tippy/css/tippy.min.css',
            'Help_Desk.css' => SA_EL_ADDONS_PATH . 'Elements/Help_Desk/assets/index.min.css',
        ],
        'js' => [
            'popper.min.js' => SA_EL_ADDONS_PATH . 'assets/vendor/popper/js/popper.min.js',
            'tippy.min.js' => SA_EL_ADDONS_PATH . 'assets/vendor/tippy/js/tippy.min.js',
            'Help_Desk.js' => SA_EL_ADDONS_PATH . 'Elements/Help_Desk/assets/index.min.js',
        ]
    ],
    'category' => 'Customer Support',
    'Premium' => TRUE,
    'condition' => '',
    'preview' => 'https://www.sa-elementor-addons.com/elements/help-desk/',
    'docs' => 'https://www.sa-elementor-addons.com/docs/customer-support/help-desk/',
];
