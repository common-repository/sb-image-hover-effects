<?php

return [
    'get_name' => 'sa_el_scroll_button',
    'name' => 'Scroll_Button',
    'class' => '\SA_EL_ADDONS\Elements\Scroll_Button\Scroll_Button',
    'dependency' => [
        'css' => [
            'Scroll_Button.css' => SA_EL_ADDONS_PATH . 'Elements/Scroll_Button/assets/index.min.css',
        ],
        'js' => [
            'jquery.scrollTo.min.js' => SA_EL_ADDONS_PATH . 'assets/vendor/scrollto/js/jquery.scrollTo.min.js',
            'Scroll_Button.js' => SA_EL_ADDONS_PATH . 'Elements/Scroll_Button/assets/index.min.js',
        ],
    ],
    'category' => 'Dynamic Contents',
    'Premium' => TRUE,
    'condition' => '',
    'preview' => 'https://www.sa-elementor-addons.com/elements/scroll-button/',
    'docs' => 'https://www.sa-elementor-addons.com/docs/dynamic-contents/scroll-button/',
];
