<?php

return [
    'get_name' => 'sa-el-testimonial-slider',
    'name' => 'Testimonial_Slider',
    'class' => '\SA_EL_ADDONS\Elements\Testimonial_Slider\Testimonial_Slider',
    'dependency' => [
        'css' => [
            'Testimonial_Slider.css' => SA_EL_ADDONS_PATH . 'Elements/Testimonial_Slider/assets/index.min.css',
        ],
        'js' => [
            'Testimonial_Slider.js' => SA_EL_ADDONS_PATH . 'Elements/Testimonial_Slider/assets/index.min.js',
        ],
    ],
    'preview' => 'https://www.sa-elementor-addons.com/elements/testimonial-slider/',
    'docs' => 'https://www.sa-elementor-addons.com/docs/carousel-slider/testimonial-slider/',
    'category' => 'Carousel & Slider',
    'Premium' => TRUE,
    'condition' => '',
];
