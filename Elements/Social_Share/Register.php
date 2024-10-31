<?php

return [
    'get_name' => 'sa_el_social_share',
    'name' => 'Social_Share',
    'class' => '\SA_EL_ADDONS\Elements\Social_Share\Social_Share',
    'dependency' => [
        'css' => [
            'Social_Share.css' => SA_EL_ADDONS_PATH . 'Elements/Social_Share/assets/index.min.css',
        ],
        'js' => [
            'goodshare.min.js' => SA_EL_ADDONS_PATH . 'assets/vendor/goodshare/js/goodshare.min.js',
        ],
    ],
    'preview' => 'https://www.sa-elementor-addons.com/docs/social-elements/social-share/',
    'docs' => 'https://www.sa-elementor-addons.com/elements/social-share/',
    'category' => 'Social Elements',
    'Premium' => FALSE,
    'condition' => '',
];
