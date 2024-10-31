<?php

return [
    'get_name' => 'sa_el_alert_box',
    'name' => 'Alert_Box',
    'class' => '\SA_EL_ADDONS\Elements\Alert_Box\Alert_Box',
    'dependency' => [
        'css' => [
            'alert.box.css' => SA_EL_ADDONS_PATH . 'Elements/Alert_Box/assets/index.min.css',
        ],
        'js' => [
            'alert.box.js' => SA_EL_ADDONS_PATH . 'Elements/Alert_Box/assets/index.min.js',
        ],
    ],
    'category' => 'Marketing Elements',
    'Premium' => FALSE,
    'condition' => '',
    'preview' => 'https://www.sa-elementor-addons.com/elements/alert-box/',
    'docs' => 'https://www.sa-elementor-addons.com/docs/marketing-elements/alert-box/',
];
