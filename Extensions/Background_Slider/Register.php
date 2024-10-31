<?php

return [
    'get_name' => 'sael-background-slider',
    'name' => 'Background_Slider',
    'class' => '\SA_EL_ADDONS\Extensions\Background_Slider\Background_Slider',
    'dependency' => [
        'css' => [
            'vegas.min.css' => SA_EL_ADDONS_PATH . 'assets/vendor/vegas/css/vegas.min.css',
            'background.slider.css' => SA_EL_ADDONS_PATH . 'Extensions/Background_Slider/assets/index.min.css',
        ],
        'js' => [
            'vegas.min.js' => SA_EL_ADDONS_PATH . 'assets/vendor/vegas/js/vegas.min.js',
            'background.slider.js' => SA_EL_ADDONS_PATH . 'Extensions/Background_Slider/assets/index.min.js',
        ],
    ],
    'category' => 'Extension',
    'Extension' => 'Elements Layouts',
    'Premium' => TRUE,
    'condition' => '',
    'API' => ''
];

