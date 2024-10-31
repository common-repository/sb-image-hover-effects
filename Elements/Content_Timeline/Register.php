<?php

return [
    'get_name' => 'sa_el_content_timeline',
    'name' => 'Content_Timeline',
    'class' => '\SA_EL_ADDONS\Elements\Content_Timeline\Content_Timeline',
    'dependency' => [
        'css' => [
          'content_timeline.css' =>  SA_EL_ADDONS_PATH . 'Elements/Content_Timeline/assets/index.min.css',
        ],
        'js' => [
          'content_timeline.js' =>  SA_EL_ADDONS_PATH . 'Elements/Content_Timeline/assets/index.min.js',
        ],
    ],
    'category' => 'Post Elements',
    'Premium' => TRUE,
    'condition' => '',
    'preview' => 'https://www.sa-elementor-addons.com/elements/content-timeline/',
    'docs' => 'https://www.sa-elementor-addons.com/docs/post-elements/content-timeline/',
];
