<?php

return [
    'get_name' => 'sa_el_protected_content',
    'name' => 'Protected_Content',
    'class' => '\SA_EL_ADDONS\Elements\Protected_Content\Protected_Content',
    'dependency' => [
        'css' => [
            'Protected_Content.css' => SA_EL_ADDONS_PATH . 'Elements/Protected_Content/assets/index.min.css',
        ],
    ],
    'category' => 'Creative Elements',
    'Premium' => FALSE,
    'condition' => '',
    'preview' => 'https://www.sa-elementor-addons.com/elements/protected-content/',
    'docs' => 'https://www.sa-elementor-addons.com/docs/creative-elements/protected-content/',
];
