<?php

return [
    'get_name' => 'sa_el_img_hotspots',
    'name' => 'Image_Hotspots',
    'class' => '\SA_EL_ADDONS\Elements\Image_Hotspots\Image_Hotspots',
    'dependency' => [
        'css' => [
            'img_hotspots.css' => SA_EL_ADDONS_PATH . 'Elements/Image_Hotspots/assets/index.min.css',
        ],
        'js' => [
            'tipso.min.js' => SA_EL_ADDONS_PATH . 'assets/vendor/tipso/js/tipso.min.js',
            'img_hotspots.js' => SA_EL_ADDONS_PATH . 'Elements/Image_Hotspots/assets/index.min.js',
        ]
    ],
    'category' => 'Image Elements',
    'Premium' => FALSE,
    'condition' => '',
    'preview' => 'https://www.sa-elementor-addons.com/elements/image-hotspots/',
    'docs' => 'https://www.sa-elementor-addons.com/docs/image-elements/image-hotspots/',
];
