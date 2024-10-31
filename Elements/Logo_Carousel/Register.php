<?php

return [
    'get_name' => 'sa_el_logo_carousel',
    'name' => 'Logo_Carousel',
    'class' => '\SA_EL_ADDONS\Elements\Logo_Carousel\Logo_Carousel',
    'dependency' => [
        'css' => [
            'Logo_Carousel.css' => SA_EL_ADDONS_PATH . 'Elements/Logo_Carousel/assets/index.min.css',
        ],
        'js' => [
            'Logo_Carousel.js' => SA_EL_ADDONS_PATH . 'Elements/Logo_Carousel/assets/index.min.js',
        ],
    ],
    'category' => 'Carousel & Slider',
    'Premium' => TRUE,
    'condition' => '',
    'preview' => 'https://www.sa-elementor-addons.com/elements/logo-carousel/',
    'docs' => 'https://www.sa-elementor-addons.com/docs/carousel-slider/logo-carousel/',
];
