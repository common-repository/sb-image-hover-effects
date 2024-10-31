<?php

return [
    'get_name' => 'sa_el_image_layers',
    'name' => 'Image_Layers',
    'class' => '\SA_EL_ADDONS\Elements\Image_Layers\Image_Layers',
    'dependency' => [
        'css' => [
            'Image_Layers.css' => SA_EL_ADDONS_PATH . 'Elements/Image_Layers/assets/index.min.css',
        ],
        'js' => [
            'parallax.min.js' => SA_EL_ADDONS_PATH . 'assets/vendor/parallax/js/parallax.min.js',
            'TweenMax.min.js' => SA_EL_ADDONS_PATH . 'assets/vendor/TweenMax/js/TweenMax.min.js',
            'universal-tilt.min.js' => SA_EL_ADDONS_PATH . 'assets/vendor/universal-tilt/js/universal-tilt.min.js',
            'Image_Layers.js' => SA_EL_ADDONS_PATH . 'Elements/Image_Layers/assets/index.min.js',
        ],
    ],
    'category' => 'Image Elements',
    'Premium' => TRUE,
    'condition' => '',
    'preview' => 'https://www.sa-elementor-addons.com/elements/image-layers/',
    'docs' => 'https://www.sa-elementor-addons.com/docs/image-elements/image-layers/',
];
