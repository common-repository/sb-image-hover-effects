<?php

return [
    'get_name' => 'sa_el_card_slider',
    'name' => 'Card_Slider',
    'class' => '\SA_EL_ADDONS\Elements\Card_Slider\Card_Slider',
    'dependency' => [
        'css' => [
            'card.slider.css' => SA_EL_ADDONS_PATH . 'Elements/Card_Slider/assets/index.min.css',
        ],
        'js' => [
            'card.slider.js' => SA_EL_ADDONS_PATH . 'Elements/Card_Slider/assets/index.min.js',
        ],
    ],
    'category' => 'Post Elements',
    'Premium' => TRUE,
    'condition' => '',
    'preview' => 'https://www.sa-elementor-addons.com/elements/card-slider/',
    'docs' => 'https://www.sa-elementor-addons.com/docs/post-elements/card-slider/',
];
