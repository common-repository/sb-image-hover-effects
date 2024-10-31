<?php

return [
    'get_name' => 'sa-el-team-member-carousel',
    'name' => 'Team_Member_Carousel',
    'class' => '\SA_EL_ADDONS\Elements\Team_Member_Carousel\Team_Member_Carousel',
    'dependency' => [
        'css' => [
            'Team_Member_Carousel.css' => SA_EL_ADDONS_PATH . 'Elements/Team_Member_Carousel/assets/index.min.css',
        ],
        'js' => [
            'Team_Member_Carousel.js' => SA_EL_ADDONS_PATH . 'Elements/Team_Member_Carousel/assets/index.min.js',
        ],
    ],
    'preview' => 'https://www.sa-elementor-addons.com/elements/team-member-carousel/',
    'docs' => 'https://www.sa-elementor-addons.com/docs/carousel-slider/team-member-carousel/',
    'category' => 'Carousel & Slider',
    'Premium' => TRUE,
    'condition' => '',
];
