<?php

return [
    'get_name' => 'sa_el_post_block',
    'name' => 'Post_Block',
    'class' => '\SA_EL_ADDONS\Elements\Post_Block\Post_Block',
    'dependency' => [
        'css' => [
            'Post_Block.css' => SA_EL_ADDONS_PATH . 'Elements/Post_Block/assets/index.min.css',
        ],
        'js' => [
            'Post_Block.js' => SA_EL_ADDONS_PATH . 'Elements/Post_Block/assets/index.min.js',
        ],
    ],
    'category' => 'Post Elements',
    'Premium' => FALSE,
    'condition' => '',
    'preview' => 'https://www.sa-elementor-addons.com/elements/post-block/',
    'docs' => 'https://www.sa-elementor-addons.com/docs/post-elements/post-block/',
];
