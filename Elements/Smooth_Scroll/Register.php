<?php

return [
    'get_name' => 'sa_el_smooth_scroll',
    'name' => 'Smooth_Scroll',
    'class' => '\SA_EL_ADDONS\Elements\Smooth_Scroll\Smooth_Scroll',
    'dependency' => [
        'css' => [
            'Smooth_Scroll.css' => SA_EL_ADDONS_PATH . 'Elements/Smooth_Scroll/assets/index.min.css',
        ],
        'js' => [
            'smooth-scroll.min.js' => SA_EL_ADDONS_PATH . 'assets/vendor/smooth-scroll/js/smooth-scroll.min.js',
            'Smooth_Scroll.js' => SA_EL_ADDONS_PATH . 'Elements/Smooth_Scroll/assets/index.min.js',
        ],
    ],
    'category' => 'Dynamic Contents',
    'Premium' => TRUE,
    'condition' => '',
    'preview' => 'https://www.sa-elementor-addons.com/elements/smooth-scroll/',
    'docs' => 'https://www.sa-elementor-addons.com/docs/dynamic-contents/smooth-scroll/',
];
