<?php

return [
    'get_name' => 'sa_el_breadcrumbs',
    'name' => 'Breadcrumbs',
    'class' => '\SA_EL_ADDONS\Elements\Breadcrumbs\Breadcrumbs',
    'dependency' => [
        'css' => [
            'breadcrumbs.css' => SA_EL_ADDONS_PATH . 'Elements/Breadcrumbs/assets/index.min.css',
        ],
    ],
    'category' => 'Header Elements',
    'Premium' => TRUE,
    'condition' => '',
    'preview' => 'https://www.sa-elementor-addons.com/elements/breadcrumbs/',
    'docs' => 'https://www.sa-elementor-addons.com/docs/header-elements/breadcrumbs/',
];
