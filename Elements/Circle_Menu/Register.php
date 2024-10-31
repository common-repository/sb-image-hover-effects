<?php

return [
    'get_name' => 'sa-el-circle-menu',
    'name' => 'Circle_Menu',
    'class' => '\SA_EL_ADDONS\Elements\Circle_Menu\Circle_Menu',
    'dependency' => [
        'css' => [
            'circle.menu.index.css' => SA_EL_ADDONS_PATH . 'Elements/Circle_Menu/assets/index.min.css',
        ],
        'js' => [
            'jQuery.circleMenu.min.js' => SA_EL_ADDONS_PATH . 'assets/vendor/circleMenu/js/jQuery.circleMenu.min.js',
            'circle.menu.index.js' => SA_EL_ADDONS_PATH . 'Elements/Circle_Menu/assets/index.min.js',
        ],
    ],
    'category' => 'Header Elements',
    'Premium' => FALSE,
    'condition' => '',
    'preview' => 'https://www.sa-elementor-addons.com/elements/circle-menu/',
    'docs' => 'https://www.sa-elementor-addons.com/docs/header-elements/circle-menu/',
];
