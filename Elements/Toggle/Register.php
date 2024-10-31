<?php

return [
    'get_name' => 'sa-el-toggle',
    'name' => 'Content_Toggle',
    'class' => '\SA_EL_ADDONS\Elements\Toggle\Toggle',
    'dependency' => [
        'css' => [
            'Toggle.css' => SA_EL_ADDONS_PATH . 'Elements/Toggle/assets/index.min.css',
        ],
        'js' => [
            'Toggle.js' => SA_EL_ADDONS_PATH . 'Elements/Toggle/assets/index.min.js',
        ],
    ],
    'preview' => 'https://www.sa-elementor-addons.com/elements/toogle/',
    'docs' => 'https://www.sa-elementor-addons.com/docs/content-elements/content-toggle/',
    'category' => 'Content Elements',
    'Premium' => FALSE,
    'condition' => '',
];
