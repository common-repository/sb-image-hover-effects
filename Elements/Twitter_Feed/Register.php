<?php

return [
    'get_name' => 'sa_el_twitter_feed',
    'name' => 'Twitter_Feed',
    'class' => '\SA_EL_ADDONS\Elements\Twitter_Feed\Twitter_Feed',
    'dependency' => [
        'css' => [
            'Twitter_Feed.css' => SA_EL_ADDONS_PATH . 'Elements/Twitter_Feed/assets/index.min.css',
        ],
        'js' => [
            'imagesloaded.pkgd.min.js' => SA_EL_ADDONS_PATH . 'assets/vendor/imagesLoaded/js/imagesloaded.pkgd.min.js',
            'isotope.pkgd.min.js' => SA_EL_ADDONS_PATH . 'assets/vendor/isotope/js/isotope.pkgd.min.js',
            'Twitter_Feed.js' => SA_EL_ADDONS_PATH . 'Elements/Twitter_Feed/assets/index.min.js',
        ],
    ],
    'preview' => 'https://www.sa-elementor-addons.com/elements/twitter-feed/',
    'docs' => 'https://www.sa-elementor-addons.com/docs/social-elements/twitter-feed/',
    'category' => 'Social Elements',
    'Premium' => TRUE,
    'condition' => '',
];
