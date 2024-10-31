<?php

return [
    'get_name' => 'sa_el_devices',
    'name' => 'Devices',
    'class' => '\SA_EL_ADDONS\Elements\Devices\Devices',
    'dependency' => [
        'css' => [
            'devices.css' => SA_EL_ADDONS_PATH . 'Elements/Devices/assets/index.min.css',
        ],
        'js' => [
            'video-player.min.js' => SA_EL_ADDONS_PATH . 'Elements/Devices/assets/video-player.min.js',
            'iphone-inline-video.min.js' => SA_EL_ADDONS_PATH . 'assets/vendor/iphone-inline-video/js/iphone-inline-video.min.js',
            'jquery-appear.min.js' => SA_EL_ADDONS_PATH . 'assets/vendor/jquery-appear/js/jquery-appear.min.js',
            'devices.js' => SA_EL_ADDONS_PATH . 'Elements/Devices/assets/index.min.js',
        ],
    ],
    'category' => 'Creative Elements',
    'Premium' => TRUE,
    'condition' => '',
    'preview' => 'https://www.sa-elementor-addons.com/elements/devices/',
    'docs' => 'https://www.sa-elementor-addons.com/docs/creative-elements/devices/',
];
