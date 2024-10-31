<?php

return [
    'get_name' => 'sa_el_qe_code',
    'name' => 'Qr_Code',
    'class' => '\SA_EL_ADDONS\Elements\Qr_Code\Qr_Code',
    'dependency' => [
        'css' => [
            'Qr_Code.css' => SA_EL_ADDONS_PATH . 'Elements/Qr_Code/assets/index.min.css',
        ],
        'js' => [
            'jquery-qrcode.min.js' => SA_EL_ADDONS_PATH . 'assets/vendor/qrcode/js/jquery-qrcode.min.js',
            'Qr_Code.js' => SA_EL_ADDONS_PATH . 'Elements/Qr_Code/assets/index.min.js',
        ]
    ],
    'category' => 'Marketing Elements',
    'Premium' => TRUE,
    'condition' => '',
    'preview' => 'https://www.sa-elementor-addons.com/elements/qr-code/',
    'docs' => 'https://www.sa-elementor-addons.com/docs/marketing-elements/qr-code/',
];
