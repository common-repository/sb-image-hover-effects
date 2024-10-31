<?php

return [
    'get_name' => 'sa_el_preview_window',
    'name' => 'Preview_Window',
    'class' => '\SA_EL_ADDONS\Elements\Preview_Window\Preview_Window',
    'dependency' => [
        'css' => [
            'tooltipster.bundle.min.css' => SA_EL_ADDONS_PATH . 'assets/vendor/tooltipster/css/tooltipster.bundle.min.css',
            'Preview_Window.css' => SA_EL_ADDONS_PATH . 'Elements/Preview_Window/assets/index.min.css',
        ],
        'js' => [
            'tooltipster.bundle.min.js' => SA_EL_ADDONS_PATH . 'assets/vendor/tooltipster/js/tooltipster.bundle.min.js',
            'Preview_Window.js' => SA_EL_ADDONS_PATH . 'Elements/Preview_Window/assets/index.min.js',
        ],
    ],
    'category' => 'Image Elements',
    'Premium' => TRUE,
    'condition' => '',
    'preview' => 'https://www.sa-elementor-addons.com/elements/preview-window/',
    'docs' => 'https://www.sa-elementor-addons.com/docs/image-elements/preview-window/',
];
