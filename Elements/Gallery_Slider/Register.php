<?php

return [
    'get_name' => 'sa_el_gallery_slider',
    'name' => 'Gallery_Slider',
    'class' => '\SA_EL_ADDONS\Elements\Gallery_Slider\Gallery_Slider',
    'dependency' => [
        'css' => [
            'gallery_slider.css' => SA_EL_ADDONS_PATH . 'Elements/Gallery_Slider/assets/index.min.css',
        ],
        'js' => [
            'jquery.resize.min.js' => SA_EL_ADDONS_PATH . 'assets/vendor/jquery-resize/js/jquery.resize.min.js',
            'gallery_slider.js' => SA_EL_ADDONS_PATH . 'Elements/Gallery_Slider/assets/index.min.js',
        ]
    ],
    'category' => 'Carousel & Slider',
    'Premium' => TRUE,
    'condition' => '',
    'preview' => 'https://www.sa-elementor-addons.com/elements/gallery-slider/',
    'docs' => 'https://www.sa-elementor-addons.com/docs/carousel-slider/gallery-slider/',
];
