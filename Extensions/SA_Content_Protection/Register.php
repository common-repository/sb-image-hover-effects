<?php

return [
    'get_name' => 'sael-content-protection',
    'name' => 'Content_Protection',
    'class' => '\SA_EL_ADDONS\Extensions\SA_Content_Protection\SA_Content_Protection',
    'dependency' => [
        'css' => [
            'content.protection.css' => SA_EL_ADDONS_PATH . 'Extensions/SA_Content_Protection/assets/index.min.css',
        ]
    ],
    'category' => 'Extension',
    'Extension' => 'Elements Layouts',
    'Premium' => TRUE,
    'condition' => '',
    'API' => ''
];
