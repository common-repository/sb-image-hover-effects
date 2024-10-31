<?php

return [
    'get_name' => 'sa_el_content_ticker',
    'name' => 'Content_Ticker',
    'class' => '\SA_EL_ADDONS\Elements\Content_Ticker\Content_Ticker',
    'dependency' => [
        'css' => [
            'content.ticker.css' => SA_EL_ADDONS_PATH . 'Elements/Content_Ticker/assets/index.min.css',
        ],
        'js' => [
            'content.ticker.js' => SA_EL_ADDONS_PATH . 'Elements/Content_Ticker/assets/index.min.js',
        ],
    ],
    'category' => 'Post Elements',
    'Premium' => FALSE,
    'condition' => '',
    'preview' => 'https://www.sa-elementor-addons.com/elements/content-ticker/',
    'docs' => 'https://www.sa-elementor-addons.com/docs/post-elements/content-ticker/',
];
