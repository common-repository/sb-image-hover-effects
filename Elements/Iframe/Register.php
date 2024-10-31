<?php

return [
    'get_name' => 'sa-el-icon-box',
    'name' => 'Iframe',
    'class' => '\SA_EL_ADDONS\Elements\Iframe\Iframe',
    'dependency' => [
        'css' => [
            'iframe.index.css' => SA_EL_ADDONS_PATH . 'Elements/Iframe/assets/index.min.css',
        ],
        'js' => [
            'recliner.min.js' => SA_EL_ADDONS_PATH . 'assets/vendor/recliner/js/recliner.min.js',
            'iframe-box.js' => SA_EL_ADDONS_PATH . 'Elements/Iframe/assets/index.min.js',
        ]
    ],
    'category' => 'Content Elements',
    'Premium' => FALSE,
    'condition' => '',
    'preview' => 'https://www.sa-elementor-addons.com/elements/iframe/',
    'docs' => 'https://www.sa-elementor-addons.com/docs/content-elements/iframe/',
];
