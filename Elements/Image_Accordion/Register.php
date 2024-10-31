<?php

return [
    'get_name' => 'sa_el_img_accordion',
    'name' => 'Image_Accordion',
    'class' => '\SA_EL_ADDONS\Elements\Image_Accordion\Image_Accordion',
    'dependency' => [
        'css' => [
            'img.accordion.css' => SA_EL_ADDONS_PATH . 'Elements/Image_Accordion/assets/index.min.css',
        ],
        'js' => [
            'img.accordion.js' => SA_EL_ADDONS_PATH . 'Elements/Image_Accordion/assets/index.min.js',
        ]
    ],
    'category' => 'Image Elements',
    'Premium' => TRUE,
    'condition' => '',
    'preview' => 'https://www.sa-elementor-addons.com/elements/image-accordion/',
    'docs' => 'https://www.sa-elementor-addons.com/docs/image-elements/image-accordion/',
];
