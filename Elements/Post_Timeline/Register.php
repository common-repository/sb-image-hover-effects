<?php

return [
    'get_name' => 'sa_el_post_timeline',
    'name' => 'Post_Timeline',
    'class' => '\SA_EL_ADDONS\Elements\Post_Timeline\Post_Timeline',
    'dependency' => [
        'css' => [
            'Post_Timeline.css' => SA_EL_ADDONS_PATH . 'Elements/Post_Timeline/assets/index.min.css',
        ],
        'js' => [
            'Post_Timeline.js' => SA_EL_ADDONS_PATH . 'Elements/Post_Timeline/assets/index.min.js',
        ],
    ],
    'category' => 'Post Elements',
    'Premium' => true,
    'condition' => '',
    'preview' => 'https://www.sa-elementor-addons.com/elements/post-timeline/',
    'docs' => 'https://www.sa-elementor-addons.com/docs/post-elements/post-timeline/',
];
