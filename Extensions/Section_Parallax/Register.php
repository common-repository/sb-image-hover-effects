<?php

return [
    'get_name' => 'sael-section-parallax',
    'name' => 'Section_Parallax',
    'class' => '\SA_EL_ADDONS\Extensions\Section_Parallax\Section_Parallax',
    'dependency' => [
        'css' => [
            'parallax.min.css' => SA_EL_ADDONS_PATH . 'Extensions/Section_Parallax/assets/index.min.css'
        ],
        'js' => [
            'TweenMax.min.js' => SA_EL_ADDONS_PATH . 'assets/vendor/TweenMax/js/TweenMax.min.js',
            'jarallax.min.js' => SA_EL_ADDONS_PATH . 'assets/vendor/jarallax/js/jarallax.min.js',
            'parallax.min.js' => SA_EL_ADDONS_PATH . 'Extensions/Section_Parallax/assets/index.min.js',
        ],
    ],
    'category' => 'Extension',
    'Extension' => 'Section Layouts',
    'Premium' => FALSE,
    'condition' => '',
    'API' => ''
];
