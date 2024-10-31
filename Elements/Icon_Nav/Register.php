<?php

return [
    'get_name' => 'sa_el_icon_nav',
    'name' => 'Icon_Nav',
    'class' => '\SA_EL_ADDONS\Elements\Icon_Nav\Icon_Nav',
    'dependency' => [
        'css' => [
            'tippy.min.css' => SA_EL_ADDONS_PATH . 'assets/vendor/tippy/css/tippy.min.css',
            'Icon_Nav.css' => SA_EL_ADDONS_PATH . 'Elements/Icon_Nav/assets/index.min.css',
        ],
        'js' => [
            'popper.min.js' => SA_EL_ADDONS_PATH . 'assets/vendor/popper/js/popper.min.js',
            'tippy.min.js' => SA_EL_ADDONS_PATH . 'assets/vendor/tippy/js/tippy.min.js',
            'Icon_Nav.js' => SA_EL_ADDONS_PATH . 'Elements/Icon_Nav/assets/index.min.js',
        ],
    ],
    'preview' => 'https://www.sa-elementor-addons.com/elements/icon-nav/',
    'docs' => 'https://www.sa-elementor-addons.com/docs/header-elements/icon-nav/',
    'category' => 'Header Elements',
    'Premium' => TRUE,
    'condition' => '',
];
