<?php

return [
    'get_name' => 'sa_el_image_magnifier',
    'name' => 'Image_Magnifier',
    'class' => '\SA_EL_ADDONS\Elements\Image_Magnifier\Image_Magnifier',
    'dependency' => [
        'css' => [
            'imagezoom.css' => SA_EL_ADDONS_PATH . 'assets/vendor/imagezoom/css/imagezoom.css',
            'Image_Magnifier.css' => SA_EL_ADDONS_PATH . 'Elements/Image_Magnifier/assets/index.min.css',
        ],
        'js' => [
            'jquery.imagezoom.min.js' => SA_EL_ADDONS_PATH . 'assets/vendor/imagezoom/js/jquery.imagezoom.min.js',
            'Image_Magnifier.js' => SA_EL_ADDONS_PATH . 'Elements/Image_Magnifier/assets/index.min.js',
        ],
    ],
    'category' => 'Image Elements',
    'Premium' => TRUE,
    'condition' => '',
    'preview' => 'https://www.sa-elementor-addons.com/elements/image-magnifier/',
    'docs' => 'https://www.sa-elementor-addons.com/docs/image-elements/image-magnifier/',
];
