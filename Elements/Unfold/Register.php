<?php

return [
    'get_name' => 'sa_el_unfold',
    'name' => 'Unfold',
    'class' => '\SA_EL_ADDONS\Elements\Unfold\Unfold',
    'dependency' => [
        'css' => [
            'Unfold.css' => SA_EL_ADDONS_PATH . 'Elements/Unfold/assets/index.min.css',
        ],
        'js' => [
            'Unfold.js' => SA_EL_ADDONS_PATH . 'Elements/Unfold/assets/index.min.js',
        ],
    ],
    'preview' => 'https://www.sa-elementor-addons.com/elements/unfold/',
    'docs' => 'https://www.sa-elementor-addons.com/docs/dynamic-contents/unfold/',
    'category' => 'Dynamic Contents',
    'Premium' => FALSE,
    'condition' => '',
];
