<?php

return [
    'get_name' => 'sa_el_feature_list',
    'name' => 'Feature_List',
    'class' => '\SA_EL_ADDONS\Elements\Feature_List\Feature_List',
    'dependency' => [
        'css' => [
           'feature_list.css' => SA_EL_ADDONS_PATH . 'Elements/Feature_List/assets/index.min.css',
        ]
    ],
    'category' => 'Content Elements',
    'Premium' => FALSE,
    'condition' => '',
    'preview' => 'https://www.sa-elementor-addons.com/elements/feature-list/',
    'docs' => 'https://www.sa-elementor-addons.com/docs/content-elements/feature-list/',
];
