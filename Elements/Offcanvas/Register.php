<?php

return [
    'get_name' => 'sa_el_offcanvas',
    'name' => 'Offcanvas',
    'class' => '\SA_EL_ADDONS\Elements\Offcanvas\Offcanvas',
    'dependency' => [
        'css' => [
            'Offcanvas.css' => SA_EL_ADDONS_PATH . 'Elements/Offcanvas/assets/index.min.css',
        ],
        'js' => [
            'offcanvas.min.js' => SA_EL_ADDONS_PATH . 'assets/vendor/offcanvas/js/offcanvas.min.js',
            'Offcanvas.js' => SA_EL_ADDONS_PATH . 'Elements/Offcanvas/assets/index.min.js',
        ],
    ],
    'category' => 'Content Elements',
    'Premium' => TRUE,
    'condition' => '',
    'preview' => 'https://www.sa-elementor-addons.com/elements/offcanvas/',
    'docs' => 'https://www.sa-elementor-addons.com/docs/content-elements/offcanvas/',
];
