<?php

return [
    'get_name' => 'sa_el_post_carousel',
    'name' => 'Post_Carousel',
    'class' => '\SA_EL_ADDONS\Elements\Post_Carousel\Post_Carousel',
    'dependency' => [
        'css' => [
            'Post_Carousel.css' => SA_EL_ADDONS_PATH . 'Elements/Post_Carousel/assets/index.min.css',
        ],
        'js' => [
            'Post_Carousel.js' => SA_EL_ADDONS_PATH . 'Elements/Post_Carousel/assets/index.min.js',
        ],
    ],
    'category' => 'Post Elements',
    'Premium' => TRUE,
    'condition' => '',
    'preview' => 'https://www.sa-elementor-addons.com/elements/post-carousel/',
    'docs' => 'https://www.sa-elementor-addons.com/docs/post-elements/post-carousel/',
];
