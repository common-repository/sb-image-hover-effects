<?php

return [
    'get_name' => 'sa_el_post_grid',
    'name' => 'Post_Grid',
    'class' => '\SA_EL_ADDONS\Elements\Post_Grid\Post_Grid',
    'dependency' => [
        'css' => [
            'Post_Grid.css' => SA_EL_ADDONS_PATH . 'Elements/Post_Grid/assets/index.min.css',
        ],
        'js' => [
            'Post_Grid.js' => SA_EL_ADDONS_PATH . 'Elements/Post_Grid/assets/index.min.js',
        ],
    ],
    'category' => 'Post Elements',
    'Premium' => true,
    'condition' => '',
    'preview' => 'https://www.sa-elementor-addons.com/elements/post-grid/',
    'docs' => 'https://www.sa-elementor-addons.com/docs/post-elements/post-grid/',
];
