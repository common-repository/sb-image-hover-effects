<?php

return [
    'get_name' => 'sa-el-card',
    'name' => 'Card',
    'class' => '\SA_EL_ADDONS\Elements\Card\Card',
    'dependency' => [
        'css' => [
          'card.css' =>  SA_EL_ADDONS_PATH . 'Elements/Card/assets/index.min.css',
        ],
    ],
    'category' => 'Content Elements',
    'Premium' => FALSE,
    'condition' => '',
    'preview' => 'https://www.sa-elementor-addons.com/elements/card/',
    'docs' => 'https://www.sa-elementor-addons.com/docs/content-elements/card/',
];
