<?php

return [
    'get_name' => 'sa_el_behance_feed',
    'name' => 'Behance_Feed',
    'class' => '\SA_EL_ADDONS\Elements\Behance_Feed\Behance_Feed',
    'dependency' => [
        'css' => [
            'Behance_Feed.css' => SA_EL_ADDONS_PATH . 'Elements/Behance_Feed/assets/index.min.css',
        ],
        'js' => [
            'embed.behance.min.js' => SA_EL_ADDONS_PATH . 'assets/vendor/behance/js/embed.behance.min.js',
            'Behance_Feed.js' => SA_EL_ADDONS_PATH . 'Elements/Behance_Feed/assets/index.min.js',
        ],
    ],
    'Premium' => TRUE,
    'condition' => '',
    'docs' => 'https://www.sa-elementor-addons.com/docs/social-elements/behance-feed/',
    'preview' => 'https://www.sa-elementor-addons.com/elements/behance-feed/',
    'category' => 'Social Elements',
];
