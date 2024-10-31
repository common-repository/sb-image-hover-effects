<?php

return [
    'get_name' => 'sael-advance-ribon',
    'name' => 'Ribon',
    'class' => '\SA_EL_ADDONS\Extensions\SA_Ribon\SA_Ribon',
    'dependency' => [
        'css' => [
            'ribon.css' => SA_EL_ADDONS_PATH . 'Extensions/SA_Ribon/assets/index.min.css',
        ],
    ],
    'category' => 'Extension',
    'Extension' => 'Elements Layouts',
    'Premium' => TRUE,
    'condition' => '',
    'API' => ''
];
