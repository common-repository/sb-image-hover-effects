<?php

return [
    'get_name' => 'sa_el_Counter',
    'name' => 'Counter',
    'class' => '\SA_EL_ADDONS\Elements\Counter\Counter',
    'dependency' => [
        'css' => [
            'odometer-theme-default.min.css' => SA_EL_ADDONS_PATH . 'assets/vendor/odometer/css/odometer-theme-default.min.css',
            'counter.css' => SA_EL_ADDONS_PATH . 'Elements/Counter/assets/index.min.css',
        ],
        'js' => [
            'waypoints.min.js' => SA_EL_ADDONS_PATH . 'assets/vendor/waypoints/js/waypoints.min.js',
            'odometer.min.js' => SA_EL_ADDONS_PATH . 'assets/vendor/odometer/js/odometer.min.js',
            'counter.js' => SA_EL_ADDONS_PATH . 'Elements/Counter/assets/index.min.js',
        ],
    ],
    'category' => 'Creative Elements',
    'Premium' => FALSE,
    'condition' => '',
    'preview' => 'https://www.sa-elementor-addons.com/elements/counter/',
    'docs' => 'https://www.sa-elementor-addons.com/docs/creative-elements/counter/',
];
