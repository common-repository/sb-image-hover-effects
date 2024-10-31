<?php

return [
    'get_name' => 'sa_el_one_page_navigation',
    'name' => 'One_Page_Navigation',
    'class' => '\SA_EL_ADDONS\Elements\One_Page_Navigation\One_Page_Navigation',
    'dependency' => [
        'css' => [
            'One_Page_Navigation.css' => SA_EL_ADDONS_PATH . 'Elements/One_Page_Navigation/assets/index.min.css',
        ],
        'js' => [
            'One_Page_Navigation.js' => SA_EL_ADDONS_PATH . 'Elements/One_Page_Navigation/assets/index.min.js',
        ],
    ],
    'category' => 'Content Elements',
    'Premium' => TRUE,
    'condition' => '',
    'preview' => 'https://www.sa-elementor-addons.com/elements/one-page-navigation/',
    'docs' => 'https://www.sa-elementor-addons.com/docs/content-elements/one-page-navigation/',
];
