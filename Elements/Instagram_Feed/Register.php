<?php

return [
    'get_name' => 'sa_el_instagram_feed',
    'name' => 'Instagram_Feed',
    'class' => '\SA_EL_ADDONS\Elements\Instagram_Feed\Instagram_Feed',
    'dependency' => [
        'css' => [
            'Instagram_Feed.css' => SA_EL_ADDONS_PATH . 'Elements/Instagram_Feed/assets/index.min.css',
        ],
        'js' => [
            'imagesloaded.pkgd.min.js' => SA_EL_ADDONS_PATH . 'assets/vendor/imagesLoaded/js/imagesloaded.pkgd.min.js',
            'isotope.pkgd.min.js' => SA_EL_ADDONS_PATH . 'assets/vendor/isotope/js/isotope.pkgd.min.js',
            'Instagram_Feed.js' => SA_EL_ADDONS_PATH . 'Elements/Instagram_Feed/assets/index.min.js',
        ],
    ],
    'category' => 'Social Elements',
    'Premium' => FALSE,
    'condition' => '',
    'preview' => 'https://www.sa-elementor-addons.com/elements/instagram-feed/',
    'docs' => 'https://www.sa-elementor-addons.com/docs/social-elements/instagram-feed/',
];
