<?php

return [
    'name' => 'Facebook_Feed',
    'class' => '\SA_EL_ADDONS\Elements\Facebook_Feed\Facebook_Feed',
    'dependency' => [
        'css' => [
            SA_EL_ADDONS_PATH . 'Elements/Facebook_Feed/assets/index.min.css',
        ],
        'js' => [
            SA_EL_ADDONS_PATH . 'assets/vendor/imagesLoaded/js/imagesloaded.pkgd.min.js',
            SA_EL_ADDONS_PATH . 'assets/vendor/isotope/js/isotope.pkgd.min.js',
            SA_EL_ADDONS_PATH . 'Elements/Facebook_Feed/assets/index.min.js',
        ],
    ],
    'category' => 'Social Elements',
    'Premium' => TRUE,
    'condition' => '',
    'preview' => 'https://www.sa-elementor-addons.com/elements/facebook-feed/',
    'docs' => 'https://www.sa-elementor-addons.com/docs/social-elements/facebook-feed/',
];
