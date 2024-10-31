<?php

return [
    'get_name' => 'sa_el_img_comparison',
    'name' => 'Image_Comparison',
    'class' => '\SA_EL_ADDONS\Elements\Image_Comparison\Image_Comparison',
    'dependency' => [
        'css' => [
            'twentytwenty.min.css' => SA_EL_ADDONS_PATH . 'assets/vendor/twentytwenty/css/twentytwenty.min.css',
            'img_comparison.css' => SA_EL_ADDONS_PATH . 'Elements/Image_Comparison/assets/index.min.css',
        ],
        'js' => [
            'jquery.event.move.min.js' => SA_EL_ADDONS_PATH . 'assets/vendor/event_move/js/jquery.event.move.min.js',
            'jquery.twentytwenty.min.js' => SA_EL_ADDONS_PATH . 'assets/vendor/twentytwenty/js/jquery.twentytwenty.min.js',
            'img_comparison.js' => SA_EL_ADDONS_PATH . 'Elements/Image_Comparison/assets/index.min.js',
        ],
    ],
    'category' => 'Image Elements',
    'Premium' => TRUE,
    'condition' => '',
    'preview' => 'https://www.sa-elementor-addons.com/elements/image-comparison/',
    'docs' => 'https://www.sa-elementor-addons.com/docs/image-elements/image-comparison/',
];
