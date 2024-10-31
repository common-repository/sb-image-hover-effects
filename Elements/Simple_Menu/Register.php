<?php

return [
    'get_name' => 'sa-el-simple-menu',
    'name' => 'Simple_Menu',
    'class' => '\SA_EL_ADDONS\Elements\Simple_Menu\Simple_Menu',
    'dependency' => [
        'css' => [
            'Simple_Menu.css' => SA_EL_ADDONS_PATH . 'Elements/Simple_Menu/assets/index.min.css',
        ],
        'js' => [
            'Simple_Menu.js' => SA_EL_ADDONS_PATH . 'Elements/Simple_Menu/assets/index.min.js',
        ],
    ],
    'category' => 'Header Elements',
    'Premium' => TRUE,
    'condition' => '',
    'preview' => 'https://www.sa-elementor-addons.com/elements/simple-menu/',
    'docs' => 'https://www.sa-elementor-addons.com/docs/header-elements/simple-menu/',
];
