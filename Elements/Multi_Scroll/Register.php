<?php

return [
    'get_name' => 'sa_el_multi_scroll',
    'name' => 'Multi_Scroll',
    'class' => '\SA_EL_ADDONS\Elements\Multi_Scroll\Multi_Scroll',
    'dependency' => [
        'css' => [
            'Multi_Scroll.css' => SA_EL_ADDONS_PATH . 'Elements/Multi_Scroll/assets/index.min.css',
        ],
        'js' => [
            'jquery.multiscroll.min.js' => SA_EL_ADDONS_PATH . 'assets/vendor/multiscroll/js/jquery.multiscroll.min.js',
            'Multi_Scroll.js' => SA_EL_ADDONS_PATH . 'Elements/Multi_Scroll/assets/index.min.js',
        ],
    ],
    'category' => 'Dynamic Contents',
    'Premium' => TRUE,
    'condition' => '',
    'preview' => 'https://www.sa-elementor-addons.com/elements/multi-scroll/',
    'docs' => 'https://www.sa-elementor-addons.com/docs/dynamic-contents/multi-scroll/',
];
